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
use Selvah\Models\Incident;
use Selvah\Models\Material;
use Selvah\Models\User;
use Selvah\Models\Zone;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Incidents extends Component
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
        'impact' => '',
        'creator' => '',
        'material' => '',
        'zone' => '',
        'finished' => '',
        'started-min' => '',
        'started-max' => '',
        'finished-min' => '',
        'finished-max' => '',
    ];

    /**
     * The model used in the component.
     *
     * @var Incident
     */
    public Incident $model;

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
     * The date when the incident started.
     *
     * @var string
     */
    public string $started_at;

    /**
     * The date when the incident finished.
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
        'material_id' => 'matérial',
        'started_at' => 'survenu le',
        'finished_at' => 'résolu le'
    ];

    /**
     * The Livewire Component constructor.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->model = $this->makeBlankModel();

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
            'model.material_id' => 'required|exists:materials,id',
            'model.description' => 'required|min:5',
            'model.impact' => 'required|in:' . collect(Incident::IMPACT)->keys()->implode(','),
            'model.is_finished' => 'required|boolean',
            'started_at' => 'required|date_format:"d-m-Y H:i"',
            'finished_at' => 'required_if:model.is_finished,true|date_format:"d-m-Y H:i"|nullable',
        ];
    }

    /**
     * Create a blank model and return it.
     *
     * @return Incident
     */
    public function makeBlankModel(): Incident
    {
        $model = Incident::make();
        $model->is_finished = $model->is_finished ?? false;

        return $model;
    }

    /**
     * Function to render the component.
     *
     * @return View
     */
    public function render()
    {
        return view('livewire.incidents', [
            'incidents' => $this->rows,
            'materials' => Material::pluck('name', 'id')->toArray(),
            'users' => User::pluck('username', 'id')->toArray(),
            'zones' => Zone::pluck('name', 'id')->toArray(),
        ]);
    }

    /**
     * Create and return the query for the items.
     *
     * @return Builder
     */
    public function getRowsQueryProperty(): Builder
    {
        $filters = $this->filters;
        $this->reset('filters');
        $this->filters = array_merge($this->filters, $filters);

        $query = Incident::query()
        ->with('material', 'user', 'material.zone')
        ->when($this->filters['impact'], fn($query, $impact) => $query->where('impact', $impact))
        ->when($this->filters['creator'], fn($query, $creator) => $query->where('user_id', $creator))
        ->when($this->filters['material'], fn($query, $material) => $query->where('material_id', $material))
        ->when($this->filters['zone'], function ($query, $zone) {
            return $query->whereHas('material', function ($partQuery) use ($zone) {
                $partQuery->where('zone_id', $zone);
            });
        })
        ->when($this->filters['finished'], function ($query, $finished) {
            return $query->where('is_finished', filter_var($finished, FILTER_VALIDATE_BOOLEAN));
        })
        ->when($this->filters['started-min'], fn($query, $date) => $query->where('started_at', '>=', Carbon::parse($date)))
        ->when($this->filters['started-max'], fn($query, $date) => $query->where('started_at', '<=', Carbon::parse($date)))
        ->when($this->filters['finished-min'], fn($query, $date) => $query->where('finished_at', '>=', Carbon::parse($date)))
        ->when($this->filters['finished-max'], fn($query, $date) => $query->where('finished_at', '<=', Carbon::parse($date)))
        ->when($this->filters['search'], function ($query, $search) {
            return $query->whereHas('material', function ($partQuery) use ($search) {
                $partQuery->where('name', 'LIKE', '%' . $search . '%');
            })
            ->orWhere('description', 'like', '%' . $search . '%');
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
        $this->authorize('create', Incident::class);

        $this->isCreating = true;
        $this->useCachedRows();

        // Reset the model to a blank model before showing the creating modal.
        if ($this->model->getKey()) {
            $this->model = $this->makeBlankModel();
            $this->started_at = '';
            $this->finished_at = '';
        }
        $this->showModal = true;
    }

    /**
     * Set the model (used in modal) to the incident we want to edit.
     *
     * @param Incident $incident The Incident id to update.
     * (Livewire will automatically fetch the model by the id)
     *
     * @return void
     */
    public function edit(Incident $incident): void
    {
        $this->authorize('update', $incident);

        $this->isCreating = false;
        $this->useCachedRows();

        // Set the model to the incident we want to edit.
        if ($this->model->isNot($incident)) {
            $this->model = $incident;
            $this->started_at = $this->model->started_at->format('d-m-Y H:i');
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
            $this->authorize('create', Incident::class);
        } else {
            $this->authorize('update', $this->model);
        }

        $this->validate();

        $this->model->started_at = Carbon::createFromFormat('d-m-Y H:i', $this->started_at);
        $this->model->finished_at = !empty($this->finished_at) ?
            Carbon::createFromFormat('d-m-Y H:i', $this->finished_at) : null;

        if ($this->model->save()) {
            $this->fireFlash('save', 'success');
        } else {
            $this->fireFlash('save', 'danger');
        }
        $this->showModal = false;
    }

    /**
     * Reset all filters to their default values
     *
     * @return void
     */
    public function resetFilters()
    {
        $this->reset('filters');
    }

    /**
     * When a filter is updated, reset the page.
     *
     * @return void
     */
    public function updatedFilters()
    {
        $this->resetPage();
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

        $fileName = 'incidents.xlsx';

        $options = new Options();
        $options->DEFAULT_COLUMN_WIDTH = 15;
        $options->DEFAULT_ROW_HEIGHT = 25;
        $options->setColumnWidth(6, 1);
        $options->setColumnWidth(25, 2);
        $options->setColumnWidth(65, 4);
        $writer = new Writer($options);
        $writer->openToBrowser($fileName);
        $writer->getCurrentSheet()->setName('Incidents');

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

        $options->mergeCells(0, 1, 8, 1, 0);

        $row = Row::fromValues(['SELVAH', '', '', '', '', '', '', '', ''], $style);
        $row->setHeight(65);
        $writer->addRow($row);

        // FICHE MAINTENANCES
        $style = (new Style())
            ->setFontSize(24)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
            ->setBorder($border);

        $options->mergeCells(0, 2, 8, 2, 0);

        $row = Row::fromValues(['Fiches Incidents', '', '', '', '', '', '', '', ''], $style);
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
            Cell::fromValue('Matériel'),
            Cell::fromValue('Créateur'),
            Cell::fromValue('Description'),
            Cell::fromValue('Zone'),
            Cell::fromValue('Créé le'),
            Cell::fromValue('Impact'),
            Cell::fromValue('Résolu'),
            Cell::fromValue('Résolu le')
        ];
        $row = new Row($cells, $style);
        $row->setHeight(65);
        $writer->addRow($row);

        Incident::query()->whereKey($this->selectedRowsQuery->get()->pluck('id')->toArray())
        ->select(['id', 'material_id', 'user_id', 'description', 'started_at', 'impact', 'is_finished', 'finished_at'])
        ->with(['user', 'material'])
        ->orderBy($this->sortField, $this->sortDirection)
        ->chunk(2000, function (Collection $incidents) use ($writer) {
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

            foreach ($incidents as $incident) {
                    $cells = [
                        Cell::fromValue($incident->id, $style),
                        Cell::fromValue($incident->material->name, $style),
                        Cell::fromValue($incident->user->username, $style),
                        Cell::fromValue($incident->description, $style),
                        Cell::fromValue($incident->material->zone->name, $style),
                        Cell::fromValue(
                            $incident->started_at->format('d-m-Y H:i'),
                            (new Style())->setFormat('d-m-Y H:i')
                                ->setCellAlignment(CellAlignment::LEFT)
                                ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
                                ->setBorder($border)
                        ),
                        Cell::fromValue($incident->impact, $style),
                        Cell::fromValue($incident->is_finished ? 'Oui' : 'Non', $style),
                        Cell::fromValue(
                            $incident->finished_at?->format('d-m-Y H:i'),
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
     * @param int $deleteCount If set, the number of permissions that has been deleted.
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
                        $this->isCreating ? "L'incident a été créé avec succès !" :
                            "L'incident <b>{$this->model->title}</b> a été édité avec succès !"
                    );
                } else {
                    session()->flash('danger', "Une erreur s'est produite lors de l'enregistrement de l'incident !");
                }
                break;

            case 'delete':
                if ($type == 'success') {
                    session()->flash('success', "<b>{$deleteCount}</b> incident(s) ont été supprimé(s) avec succès !");
                } else {
                    session()->flash('danger', "Une erreur s'est produite lors de la suppression des incidents !");
                }
                break;
        }

        // Emit the alert event to the front so the Dismiss can trigger the flash message.
        $this->emit('alert');
    }
}
