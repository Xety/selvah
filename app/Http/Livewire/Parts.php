<?php

namespace Selvah\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use InvalidArgumentException as GlobalInvalidArgumentException;
use OpenSpout\Common\Entity\Cell;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\CellVerticalAlignment;
use OpenSpout\Common\Entity\Style\Style;
use OpenSpout\Common\Entity\Style\Border;
use OpenSpout\Common\Entity\Style\BorderPart;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\InvalidArgumentException;
use OpenSpout\Writer\Exception\WriterNotOpenedException;
use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Writer\XLSX\Options;
use Selvah\Http\Livewire\Traits\WithCachedRows;
use Selvah\Http\Livewire\Traits\WithSorting;
use Selvah\Http\Livewire\Traits\WithBulkActions;
use Selvah\Http\Livewire\Traits\WithFilters;
use Selvah\Http\Livewire\Traits\WithPerPagePagination;
use Selvah\Models\Material;
use Selvah\Models\Part;
use Selvah\Models\User;

class Parts extends Component
{
    use AuthorizesRequests;
    use WithBulkActions;
    use WithCachedRows;
    use WithFilters;
    use WithPagination;
    use WithPerPagePagination;
    use WithSorting;

    /**
     * Used to update in URL the query string.
     *
     * @var string[]
     */
    protected $queryString = [
        'sortField' => ['as' => 'f'],
        'sortDirection' => ['as' => 'd'],
        'filters',
    ];

    /**
     * Filters used for advanced search.
     *
     * @var array
     */
    public array $filters = [
        'search' => '',
        'creator' => '',
        'material' => '',
        'created-min' => '',
        'created-max' => '',
    ];

    /**
     * Array of allowed fields.
     *
     * @var array
     */
    public array $allowedFields = [
        'id',
        'name',
        'material_id',
        'reference',
        'supplier',
        'price',
        'number_warning_enabled',
        'number_critical_enabled',
        'part_entry_count',
        'part_exit_count',
        'created_at'
    ];

    /**
     * The model used in the component.
     *
     * @var Part
     */
    public Part $model;

    /**
     * Used to show the Edit/Create modal.
     *
     * @var bool
     */
    public bool $showModal = false;

    /**
     * Used to show the delete modal.
     *
     * @var bool
     */
    public bool $showDeleteModal = false;

    /**
     * Used to set the modal to Create action (true) or Edit action (false).
     *
     * @var bool
     */
    public bool $isCreating = false;

    /**
     * Used to set to show/hide the advanced filters.
     *
     * @var bool
     */
    public bool $showFilters = false;

    /**
     * Number of rows displayed on a page.
     *
     * @var int
     */
    public int $perPage = 25;

    /**
     *  What ever the warning is enabled or not. Used to show/hide the related count field.
     *
     * @var boolean
     */
    public $numberWarningEnabled = false;

    /**
     *  What ever the critical warning is enabled or not. Used to show/hide the related count field.
     *
     * @var boolean
     */
    public $numberCriticalEnabled = false;

    /**
     * Translated attribute used in failed messages.
     *
     * @var string[]
     */
    protected $validationAttributes = [
        'name' => 'nom',
        'material_id' => 'matériel',
        'reference' => 'référence',
        'supplier' => 'fournisseur',
        'price' => 'prix',
        'number_warning_enabled' => 'alerte de stock',
        'number_warning_minimum' => 'quantité pour l\'alerte',
        'number_critical_enabled' => 'alerte de stock critique',
        'number_critical_minimum' => 'quantité pour l\'alerte critique',
    ];

    /**
     * The Livewire Component constructor.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->model = $this->makeBlankModel();

        $this->applySortingOnMount();

        $filters = $this->filters;
        $this->reset('filters');
        $this->filters = array_merge($this->filters, $filters);
    }

    /**
     * Rules used for validating the model.
     *
     * @return string[]
     */
    public function rules()
    {
        return [
            'model.name' => 'required|min:2|max:30|unique:parts,name,' . $this->model->id,
            'model.slug' => 'required|unique:parts,slug,' . $this->model->id,
            'model.description' => 'required|min:3',
            'model.material_id' => 'present|numeric|exists:materials,id|nullable',
            'model.reference' => 'min:2|max:30|unique:parts,reference,' . $this->model->id,
            'model.supplier' => 'min:2',
            'model.price' => 'numeric',
            'model.number_warning_enabled' => 'required|boolean',
            'model.number_warning_minimum' => 'exclude_if:model.number_warning_enabled,false|required|numeric',
            'model.number_critical_enabled' => 'required|boolean',
            'model.number_critical_minimum' => 'exclude_if:model.number_critical_enabled,false|required|numeric',
        ];
    }

    /**
     * Generate the slug assign it to the model.
     *
     * @return void
     */
    public function generateSlug(): void
    {
        $this->model->slug = Str::slug($this->model->name, '-');
    }

    /**
     * Create a blank model and return it.
     *
     * @return Part
     */
    public function makeBlankModel(): Part
    {
        $model = Part::make();
        $model->number_warning_enabled = false;
        $model->number_critical_enabled = false;

        return $model;
    }

    /**
     * Function to render the component.
     *
     * @return View
     */
    public function render()
    {
        return view('livewire.parts', [
            'parts' => $this->rows,
            'materials' => Material::pluck('name', 'id')->toArray(),
            'users' => User::pluck('username', 'id')->toArray(),
        ]);
    }

    /**
     * Create and return the query for the items.
     *
     * @return Builder
     */
    public function getRowsQueryProperty(): Builder
    {
        $query = Part::query()
        ->when($this->filters['creator'], fn($query, $creator) => $query->where('user_id', $creator))
        ->when($this->filters['material'], fn($query, $material) => $query->where('material_id', $material))
        ->when($this->filters['created-min'], fn($query, $date) => $query->where('started_at', '>=', Carbon::parse($date)))
        ->when($this->filters['created-max'], fn($query, $date) => $query->where('started_at', '<=', Carbon::parse($date)))
        ->when($this->filters['search'], function ($query, $search) {
            return $query->whereHas('material', function ($partQuery) use ($search) {
                $partQuery->where('name', 'LIKE', '%' . $search . '%');
            })
            ->orWhere('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('reference', 'like', '%' . $search . '%')
            ->orWhere('supplier', 'like', '%' . $search . '%');
        });

        return $this->applySorting($query);
    }

    /**
     * Build the query or get it from the cache and paginate it.
     *
     * @return LengthAwarePaginator
     */
    public function getRowsProperty(): LengthAwarePaginator
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    /**
     * Create a blank model and assign it to the model. (Used in create modal)
     *
     * @return void
     */
    public function create(): void
    {
        $this->authorize('create', Part::class);

        $this->isCreating = true;
        $this->useCachedRows();

        // Reset the model to a blank model before showing the creating modal.
        if ($this->model->getKey()) {
            $this->model = $this->makeBlankModel();
            $this->numberCriticalEnabled = false;
            $this->numberWarningEnabled = false;
        }
        $this->showModal = true;
    }

    /**
     * Set the model (used in modal) to the part we want to edit.
     *
     * @param Part $part The part id to update.
     * (Livewire will automatically fetch the model by the id)
     *
     * @return void
     */
    public function edit(Part $part): void
    {
        $this->authorize('update', $part);

        $this->isCreating = false;
        $this->useCachedRows();

        // Set the model to the part we want to edit.
        if ($this->model->isNot($part)) {
            $this->model = $part;
            $this->numberCriticalEnabled = $part->number_critical_enabled;
            $this->numberWarningEnabled = $part->number_warning_enabled;
        }
        $this->showModal = true;
    }

    /**
     * Validate and save the model.
     *
     * @return void
     */
    public function save(): void
    {
        if ($this->isCreating === true) {
            $this->authorize('create', Part::class);
        } else {
            $this->authorize('update', $this->model);
        }

        $this->validate();

        // If the material_id is "", assign it to null.
        $this->model->material_id = !empty($this->model->material_id) ? $this->model->material_id : null;
        // Convert the value to an integer, used when the input is "".
        $this->model->number_warning_minimum = (int)$this->model->number_warning_minimum;
        $this->model->number_critical_minimum = (int)$this->model->number_critical_minimum;

        if ($this->model->save()) {
            $this->fireFlash('save', 'success');
        } else {
            $this->fireFlash('save', 'danger');
        }
        $this->showModal = false;
    }

    /**
     * Export the selected rows to an Excel file with formatted content.
     *
     * @return StreamedResponse
     *
     * @throws IOException
     * @throws InvalidArgumentException
     * @throws WriterNotOpenedException
     * @throws InvalidCastException
     * @throws MissingAttributeException
     * @throws LogicException
     * @throws GlobalInvalidArgumentException
     * @throws BindingResolutionException
     */
    public function exportSelected()
    {
        $this->authorize('export', Incident::class);

        $fileName = 'pieces-detachees.xlsx';

        $options = new Options();
        $options->DEFAULT_COLUMN_WIDTH = 15;
        $options->DEFAULT_ROW_HEIGHT = 25;
        $options->setColumnWidth(6, 1);
        $options->setColumnWidth(55, 2);
        $options->setColumnWidth(65, 3);
        $writer = new Writer($options);
        $writer->openToBrowser($fileName);
        $writer->getCurrentSheet()->setName('Pièces Détachées');

        $border = new Border(
            new BorderPart(Border::BOTTOM, Color::BLACK, Border::WIDTH_MEDIUM, Border::STYLE_SOLID),
            new BorderPart(Border::LEFT, Color::BLACK, Border::WIDTH_MEDIUM, Border::STYLE_SOLID),
            new BorderPart(Border::RIGHT, Color::BLACK, Border::WIDTH_MEDIUM, Border::STYLE_SOLID),
            new BorderPart(Border::TOP, Color::BLACK, Border::WIDTH_MEDIUM, Border::STYLE_SOLID)
        );

        // SELVAH
        $style = (new Style())
            ->setFontSize(48)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
            ->setBorder($border);

        $options->mergeCells(0, 1, 15, 1, 0);

        $row = Row::fromValues(['SELVAH', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''], $style);
        $row->setHeight(65);
        $writer->addRow($row);

        // FICHE MAINTENANCES
        $style = (new Style())
            ->setFontSize(24)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
            ->setBorder($border);

        $options->mergeCells(0, 2, 15, 2, 0);

        $row = Row::fromValues(['Pièces Détachées', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''], $style);
        $row->setHeight(45);
        $writer->addRow($row);

        // EN-TÊTE
        $style = (new Style())
            ->setFontBold()
            ->setFontSize(15)
            ->setShouldWrapText()
            ->setCellAlignment(CellAlignment::CENTER)
            ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
            ->setBorder($border);

        $cells = [
            Cell::fromValue('ID'),
            Cell::fromValue('Nom'),
            Cell::fromValue('Description'),
            Cell::fromValue('Créateur'),
            Cell::fromValue('Matériel'),
            Cell::fromValue('Référence'),
            Cell::fromValue('Fournisseur'),
            Cell::fromValue('Nb en stock'),
            Cell::fromValue('Prix Unitaire'),
            Cell::fromValue('Prix total en stock'),
            Cell::fromValue('Nb total de pièce entrée'),
            Cell::fromValue('Nb total de pièce sortie'),
            Cell::fromValue('Nb total d\'entrée'),
            Cell::fromValue('Nb total de sortie'),
            Cell::fromValue('Créé le'),
            Cell::fromValue('Mis à jour le'),
        ];
        $row = new Row($cells, $style);
        $row->setHeight(65);
        $writer->addRow($row);

        Part::query()->whereKey($this->selectedRowsQuery->get()->pluck('id')->toArray())
        ->select(['id', 'name', 'description', 'user_id', 'material_id', 'reference', 'supplier', 'price', 'part_entry_total', 'part_exit_total', 'part_entry_count', 'part_exit_count', 'created_at', 'updated_at'])
        ->with(['user', 'material'])
        ->orderBy($this->sortField, $this->sortDirection)
        ->chunk(2000, function (Collection $parts) use ($writer) {
            $border = new Border(
                new BorderPart(Border::BOTTOM, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
                new BorderPart(Border::LEFT, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
                new BorderPart(Border::RIGHT, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
                new BorderPart(Border::TOP, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
            );
            $style = (new Style())
                ->setCellAlignment(CellAlignment::LEFT)
                ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
                ->setBorder($border);

            foreach ($parts as $part) {
                    $cells = [
                        Cell::fromValue($part->id, $style),
                        Cell::fromValue($part->name, $style),
                        Cell::fromValue($part->description, $style),
                        Cell::fromValue($part->user->username, $style),
                        Cell::fromValue($part->material->name, $style),
                        Cell::fromValue($part->reference, $style),
                        Cell::fromValue($part->supplier, $style),
                        Cell::fromValue($part->stock_total, $style),
                        Cell::fromValue($part->price, $style),
                        Cell::fromValue($part->price * $part->stock_total, $style),
                        Cell::fromValue($part->part_entry_total, $style),
                        Cell::fromValue($part->part_exit_total, $style),
                        Cell::fromValue($part->part_entry_count, $style),
                        Cell::fromValue($part->part_exit_count, $style),
                        Cell::fromValue(
                            $part->created_at->format('d-m-Y H:i'),
                            (new Style())->setFormat('d-m-Y H:i')
                                ->setCellAlignment(CellAlignment::LEFT)
                                ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
                                ->setBorder($border)
                        ),
                        Cell::fromValue(
                            $part->updated_at?->format('d-m-Y H:i'),
                            (new Style())->setFormat('d-m-Y H:i')
                                ->setCellAlignment(CellAlignment::LEFT)
                                ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
                                ->setBorder($border)
                        )
                    ];

                    $row = new Row($cells);
                    $writer->addRow($row);
            }

            flush();
        });

        return response()->streamDownload(function () use ($writer) {
                $writer->close();
        }, $fileName);
    }

    /**
     * Display a flash message regarding the action that fire it and the type of the message, then emit an
     * `alert ` event.
     *
     * @param string $action The action that fire the flash message.
     * @param string $type The type of the message, success or danger.
     * @param int $deleteCount If set, the number of parts that has been deleted.
     *
     * @return void
     */
    public function fireFlash(string $action, string $type, int $deleteCount = 0)
    {
        switch ($action) {
            case 'save':
                if ($type == 'success') {
                    session()->flash(
                        'success',
                        $this->isCreating ? "La pièce détachée a été créé avec succès !" :
                            "La pièce détachée <b>{$this->model->title}</b> a été édité avec succès !"
                    );
                } else {
                    session()->flash('danger', "Une erreur s'est produite lors de l'enregistrement de la pièce détachée !");
                }
                break;

            case 'delete':
                if ($type == 'success') {
                    session()->flash('success', "<b>{$deleteCount}</b> pièce(s) détachée(s) ont été supprimée(s) avec succès !");
                } else {
                    session()->flash('danger', "Une erreur s'est produite lors de la suppression des pièces détachées !");
                }
                break;
        }

        // Emit the alert event to the front so the DIsmiss can trigger the flash message.
        $this->emit('alert');
    }
}
