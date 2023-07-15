<?php

namespace Selvah\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use OpenSpout\Common\Entity\Cell;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\CellVerticalAlignment;
use OpenSpout\Common\Entity\Style\Style;
use OpenSpout\Common\Entity\Style\Border;
use OpenSpout\Common\Entity\Style\BorderPart;
use OpenSpout\Common\Entity\Row;
use Selvah\Http\Livewire\Traits\WithCachedRows;
use Selvah\Http\Livewire\Traits\WithSorting;
use Selvah\Http\Livewire\Traits\WithBulkActions;
use Selvah\Http\Livewire\Traits\WithPerPagePagination;
use Selvah\Models\Company;
use Selvah\Models\Material;
use Selvah\Models\Maintenance;
use Selvah\Models\User;
use Spatie\SimpleExcel\SimpleExcelWriter;

class Maintenances extends Component
{
    use WithPagination;
    use WithSorting;
    use WithCachedRows;
    use WithBulkActions;
    use WithPerPagePagination;

    /**
     * The string to search.
     *
     * @var string
     */
    public string $search = '';

    /**
     * Used to update in URL the query string.
     *
     * @var string[]
     */
    protected $queryString = [
        'sortField' => ['as' => 'f'],
        'sortDirection' => ['as' => 'd'],
        'search' => ['except' => '', 'as' => 's']
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
     * The Livewire Component constructor.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->model = $this->makeBlankModel();
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
            'model.description' => 'nullable|min:3',
            'model.reason' => 'nullable|min:3',
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
            'operators' => User::pluck('username', 'id')->toArray()
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
            ->search('description', $this->search);

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

    public function exportSelected()
    {

        $fileName = 'maintenances.xlsx';

        $writer = SimpleExcelWriter::streamDownload(
            $fileName,
            '',
            function ($writer) {
                $options = $writer->getOptions();
                $options->DEFAULT_COLUMN_WIDTH = 15;
                $options->DEFAULT_ROW_HEIGHT = 25;
                $options->setColumnWidth(6, 1);
                $options->setColumnWidth(25, 2);
                $options->setColumnWidth(35, 4);
            }
        )
        ->nameCurrentSheet('Matériels');


        $border = new Border(
            new BorderPart(Border::BOTTOM, Color::BLACK, Border::WIDTH_MEDIUM, Border::STYLE_SOLID),
            new BorderPart(Border::LEFT, Color::BLACK, Border::WIDTH_MEDIUM, Border::STYLE_SOLID),
            new BorderPart(Border::RIGHT, Color::BLACK, Border::WIDTH_MEDIUM, Border::STYLE_SOLID),
            new BorderPart(Border::TOP, Color::BLACK, Border::WIDTH_MEDIUM, Border::STYLE_SOLID)
        );

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
            Cell::fromValue('Créateur'),
            Cell::fromValue('Description'),
            Cell::fromValue('Zone'),
            Cell::fromValue('Pièces détachées en stock'),
            Cell::fromValue('Nombre d\'incidents'),
            Cell::fromValue('Nombre de maintenances'),
            Cell::fromValue('Crée le'),
            Cell::fromValue('Mis à jour le')
        ];
        $row = new Row($cells, $style);
        $row->setHeight(65);
        $writer->addRow($row);

        Material::query()->whereKey($this->selectedRowsQuery->get()->pluck('id')->toArray())
        ->select(['id','user_id', 'name', 'description', 'zone_id', 'part_count', 'incident_count', 'maintenance_count', 'created_at', 'updated_at'])
        ->with(['user', 'zone'])
        ->chunk(2000, function (Collection $materials) use ($writer) {
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

            foreach ($materials as $material) {
                    $cells = [
                        Cell::fromValue($material->id, $style),
                        Cell::fromValue($material->name, $style),
                        Cell::fromValue($material->user->username, $style),
                        Cell::fromValue($material->description, $style),
                        Cell::fromValue($material->zone->name, $style),
                        Cell::fromValue($material->part_count, $style),
                        Cell::fromValue($material->incident_count, $style),
                        Cell::fromValue($material->maintenance_count, $style),
                        Cell::fromValue(
                            $material->created_at->format('d-m-Y H:i'),
                            (new Style())->setFormat('d-m-Y H:i')
                                ->setCellAlignment(CellAlignment::LEFT)
                                ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
                                ->setBorder($border)
                        ),
                        Cell::fromValue(
                            $material->updated_at->format('d-m-Y H:i'),
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
