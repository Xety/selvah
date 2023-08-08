<?php

namespace Selvah\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Database\Eloquent\MissingAttributeException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use InvalidArgumentException as GlobalInvalidArgumentException;
use Livewire\Component;
use Livewire\WithPagination;
use LogicException;
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
use Selvah\Models\Company;
use Selvah\Models\Material;
use Selvah\Models\Maintenance;
use Selvah\Models\User;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Maintenances extends Component
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
        'qrcode' => ['except' => ''],
        'qrcodeid' => ['except' => ''],
        'filters',
    ];

    /**
     * Whatever the QR COde is set or not.
     *
     * @var bool
     */
    public bool|string $qrcode = '';

    /**
     * The QR Code id if set.
     *
     * @var int
     */
    public null|int $qrcodeid = null;

    /**
     * Filters used for advanced search.
     *
     * @var array
     */
    public array $filters = [
        'search' => '',
        'type' => '',
        'realization' => '',
        'material' => '',
        'operator' => '',
        'company' => '',
        'started-min' => '',
        'started-max' => '',
        'finished-min' => '',
        'finished-max' => '',
    ];

    /**
     * Array of allowed fields.
     *
     * @var array
     */
    public array $allowedFields = [
        'id',
        'gmao_id',
        'material_id',
        'description',
        'reason',
        'user_id',
        'type',
        'realization',
        'started_at',
        'finished_at',
        'created_at'
    ];

    /**
     * The model used in the component.
     *
     * @var Maintenance
     */
    public Maintenance $model;

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
     * @var int
     */
    public int $perPage = 25;

    /**
     * The selected companies for the maintenance.
     *
     * @var array
     */
    public array $companiesSelected = [];

    /**
     * The selected operators for the maintenance.
     *
     * @var array
     */
    public array $operatorsSelected = [];

    /**
     * The date when the maintenance started.
     *
     * @var string
     */
    public string $started_at;

    /**
     * The date when the maintenance finished.
     *
     * @var string
     */
    public string $finished_at;

    /**
     * Translated attribute used in failed messages.
     *
     * @var string[]
     */
    protected $validationAttributes = [
        'reason' => 'raison',
        'type' => 'entreprises',
        'realization' => 'réalisation',
        'operatorsSelected' => 'opérateurs',
        'companiesSelected' => 'entreprises',
        'started_at' => 'commencée le',
        'finished_at' => 'finie le'
    ];

    /**
     * The Livewire Component constructor.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->model = $this->makeBlankModel();

        if ($this->qrcode === true && $this->qrcodeid !== null) {
            $this->model->material_id = $this->qrcodeid;

            $this->create();
        }

        $this->applySortingOnMount();

        $this->applyFilteringOnMount();
    }

    /**
     * Rules used for validating the model.
     *
     * @return string[]
     */
    public function rules()
    {
        return [
            'model.gmao_id' => 'nullable|min:2|max:30|',
            'model.material_id' => 'present|numeric|exists:materials,id|nullable',
            'model.description' => 'required',
            'model.reason' => 'required',
            'model.type' => 'required|in:' . collect(Maintenance::TYPES)->keys()->implode(','),
            'model.realization' => 'required|in:' . collect(Maintenance::REALIZATIONS)->keys()->implode(','),
            'operatorsSelected' => 'required_if:model.realization,internal,both',
            'companiesSelected' => 'required_if:model.realization,external,both',
            'started_at' => 'nullable|date_format:"d-m-Y H:i"',
            'finished_at' => 'nullable|date_format:"d-m-Y H:i"',
        ];
    }

    /**
     * Create a blank model and return it.
     *
     * @return Maintenance
     */
    public function makeBlankModel(): Maintenance
    {
        $model = Maintenance::make();
        $model->type = $model->type ?? 'curative';
        $model->realization = $model->realization ?? 'external';

        return $model;
    }

    /**
     * Function to render the component.
     *
     * @return View
     */
    public function render()
    {
        return view('livewire.maintenances', [
            'maintenances' => $this->rows,
            'materials' => Material::pluck('name', 'id')->toArray(),
            'companies' => Company::pluck('name', 'id')->toArray(),
            'operators' => User::pluck('username', 'id')->toArray(),
        ]);
    }

    /**
     * Create and return the query for the items.
     *
     * @return Builder
     */
    public function getRowsQueryProperty(): Builder
    {
        $query = Maintenance::query()
            ->with('material', 'user')
            ->when($this->filters['type'], fn($query, $type) => $query->where('type', $type))
            ->when($this->filters['realization'], fn($query, $realization) => $query->where('realization', $realization))
            ->when($this->filters['material'], fn($query, $material) => $query->where('material_id', $material))
            ->when($this->filters['operator'], function ($query, $operator) {
                return $query->whereHas('operators', function ($query) use ($operator) {
                    $query->where('user_id', $operator);
                });
            })
            ->when($this->filters['company'], function ($query, $company) {
                return $query->whereHas('companies', function ($query) use ($company) {
                    $query->where('company_id', $company);
                });
            })
            ->when($this->filters['started-min'], fn($query, $date) => $query->where('started_at', '>=', Carbon::parse($date)))
            ->when($this->filters['started-max'], fn($query, $date) => $query->where('started_at', '<=', Carbon::parse($date)))
            ->when($this->filters['finished-min'], fn($query, $date) => $query->where('finished_at', '>=', Carbon::parse($date)))
            ->when($this->filters['finished-max'], fn($query, $date) => $query->where('finished_at', '<=', Carbon::parse($date)))
            ->when($this->filters['search'], function ($query, $search) {
                return $query->whereHas('material', function ($partQuery) use ($search) {
                    $partQuery->where('name', 'LIKE', '%' . $search . '%');
                })
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('reason', 'like', '%' . $search . '%')
                ->orWhere('gmao_id', 'like', '%' . $search . '%');
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
        $this->authorize('create', Maintenance::class);

        $this->isCreating = true;
        $this->useCachedRows();

        // Reset the model to a blank model before showing the creating modal.
        if ($this->model->getKey()) {
            $this->model = $this->makeBlankModel();
            $this->operatorsSelected = [];
            $this->companiesSelected = [];
            $this->started_at = '';
            $this->finished_at = '';
        }
        $this->showModal = true;
    }

    /**
     * Set the model (used in modal) to the maintenance we want to edit.
     *
     * @param Maintenance $maintenance The maintenance id to update.
     * (Livewire will automatically fetch the model by the id)
     *
     * @return void
     */
    public function edit(Maintenance $maintenance): void
    {
        $this->authorize('update', $maintenance);

        $this->isCreating = false;
        $this->useCachedRows();

        // Set the model to the maintenance we want to edit.
        if ($this->model->isNot($maintenance)) {
            $this->model = $maintenance;
            $this->operatorsSelected = $maintenance->operators->pluck('id')->toArray();
            $this->companiesSelected = $maintenance->companies->pluck('id')->toArray();
            $this->started_at = $this->model->started_at !== null ? $this->model->started_at->format('d-m-Y H:i') : '';
            $this->finished_at = $this->model->finished_at !== null ? $this->model->finished_at->format('d-m-Y H:i') : '';
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
            $this->authorize('create', Maintenance::class);
        } else {
            $this->authorize('update', $this->model);
        }

        $this->validate();

        // If the material_id is "", assign it to null.
        $this->model->material_id = !empty($this->model->material_id) ? $this->model->material_id : null;
        $this->model->started_at = !empty($this->started_at) ?
        Carbon::createFromFormat('d-m-Y H:i', $this->started_at) : null;
        $this->model->finished_at = !empty($this->finished_at) ?
            Carbon::createFromFormat('d-m-Y H:i', $this->finished_at) : null;

        // When the user has selected an operator but has changed the type,
        // we need to reset the operators list before to save to delete them.
        if ($this->model->realization === 'external') {
            $this->operatorsSelected = [];
        }
        if ($this->model->realization === 'internal') {
            $this->companiesSelected = [];
        }

        if ($this->model->save()) {
            $this->model->operators()->sync($this->operatorsSelected);
            $this->model->companies()->sync($this->companiesSelected);

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
        $this->authorize('export', Maintenance::class);

        $fileName = 'maintenances.xlsx';

        $options = new Options();
        $options->DEFAULT_COLUMN_WIDTH = 15;
        $options->DEFAULT_ROW_HEIGHT = 25;
        $options->setColumnWidth(6, 1);
        $options->setColumnWidth(15, 2);
        $options->setColumnWidthForRange(55, 4, 5);
        $writer = new Writer($options);
        $writer->openToBrowser('maintenances.xlsx');
        $writer->getCurrentSheet()->setName('Maintenances');

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

        $options->mergeCells(0, 1, 11, 1, 0);

        $row = Row::fromValues(['SELVAH', '', '', '', '', '', '', '', '', '', '', ''], $style);
        $row->setHeight(65);
        $writer->addRow($row);

        // FICHE MAINTENANCES
        $style = (new Style())
            ->setFontSize(24)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
            ->setBorder($border);

        $options->mergeCells(0, 2, 11, 2, 0);

        $row = Row::fromValues(['Fiches Maintenances', '', '', '', '', '', '', '', '', '', '', ''], $style);
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
            Cell::fromValue('GMAO ID'),
            Cell::fromValue('Matériel'),
            Cell::fromValue('Description'),
            Cell::fromValue('Raison'),
            Cell::fromValue('Créateur'),
            Cell::fromValue('Operateur(s)'),
            Cell::fromValue('Entreprise(s)'),
            Cell::fromValue('Type'),
            Cell::fromValue('Réalisation'),
            Cell::fromValue('Créé le'),
            Cell::fromValue('Résolu le')
        ];
        $row = new Row($cells, $style);
        $row->setHeight(65);
        $writer->addRow($row);

        Maintenance::query()
            ->whereKey($this->selectedRowsQuery->get()->pluck('id')->toArray())
            ->select(['id', 'gmao_id', 'material_id', 'description', 'reason', 'user_id', 'type', 'realization',  'started_at', 'finished_at'])
            ->with(['operators', 'companies', 'partExits'])
            ->orderBy($this->sortField, $this->sortDirection)
            ->chunk(2000, function (Collection $maintenances) use ($writer) {
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

                foreach ($maintenances as $maintenance) {
                        $cells = [
                            Cell::fromValue($maintenance->id, $style),
                            Cell::fromValue($maintenance->gmao_id, $style),
                            Cell::fromValue($maintenance->material?->name, $style),
                            Cell::fromValue($maintenance->description, $style),
                            Cell::fromValue($maintenance->reason, $style),
                            Cell::fromValue($maintenance->user->username, $style),
                            Cell::fromValue($maintenance->operators->pluck('username')->implode(', '), $style),
                            Cell::fromValue($maintenance->companies->pluck('name')->implode(', '), $style),
                            Cell::fromValue($maintenance->type, $style),
                            Cell::fromValue($maintenance->realization, $style),
                            Cell::fromValue(
                                $maintenance->started_at?->format('d-m-Y H:i'),
                                (new Style())->setFormat('d-m-Y H:i')
                                    ->setCellAlignment(CellAlignment::LEFT)
                                    ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
                                    ->setBorder($border)
                            ),
                            Cell::fromValue(
                                $maintenance->finished_at?->format('d-m-Y H:i'),
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
     * @param int $deleteCount If set, the number of materials that has been deleted.
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
                        $this->isCreating ? "La maintenance a été créée avec succès !" :
                            "La maintenance <b>{$this->model->title}</b> a été éditée avec succès !"
                    );
                } else {
                    session()->flash('danger', "Une erreur s'est produite lors de l'enregistrement de la maintenance !");
                }
                break;

            case 'delete':
                if ($type == 'success') {
                    session()->flash('success', "<b>{$deleteCount}</b> maintenance(s) ont été supprimée(s) avec succès !");
                } else {
                    session()->flash('danger', "Une erreur s'est produite lors de la suppression des maintenances !");
                }
                break;
        }

        // Emit the alert event to the front so the DIsmiss can trigger the flash message.
        $this->emit('alert');
    }
}
