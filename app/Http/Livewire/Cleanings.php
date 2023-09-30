<?php

namespace Selvah\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
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
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\InvalidArgumentException;
use OpenSpout\Writer\Exception\InvalidSheetNameException;
use OpenSpout\Writer\Exception\WriterNotOpenedException;
use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Writer\XLSX\Options;
use Selvah\Http\Livewire\Traits\WithCachedRows;
use Selvah\Http\Livewire\Traits\WithFlash;
use Selvah\Http\Livewire\Traits\WithSorting;
use Selvah\Http\Livewire\Traits\WithBulkActions;
use Selvah\Http\Livewire\Traits\WithFilters;
use Selvah\Http\Livewire\Traits\WithPerPagePagination;
use Selvah\Models\Cleaning;
use Selvah\Models\Material;
use Selvah\Models\User;
use Selvah\Models\Zone;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Cleanings extends Component
{
    use AuthorizesRequests;
    use WithBulkActions;
    use WithCachedRows;
    use WithFilters;
    use WithFlash;
    use WithPagination;
    use WithPerPagePagination;
    use WithSorting;

    /**
     * The field to sort by.
     *
     * @var string
     */
    public string $sortField = 'created_at';

    /**
     * The direction of the ordering.
     *
     * @var string
     */
    public string $sortDirection = 'desc';

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
     * @var int|null
     */
    public ?int $qrcodeid = null;

    /**
     * Whatever the selected material has enabled the PH test when creating/editing
     * a cleaning.
     *
     * @var bool
     */
    public bool $materialCleaningTestPhEnabled = false;

    /**
     * Filters used for advanced search.
     *
     * @var array
     */
    public array $filters = [
        'search' => '',
        'creator' => '',
        'material' => '',
        'zone' => '',
        'type' => '',
        'ph-test-water-min' => '',
        'ph-test-water-max' => '',
        'ph-test-water-after-cleaning-min' => '',
        'ph-test-water-after-cleaning-max' => '',
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
        'material_id',
        'user_id',
        'description',
        'ph_test_water',
        'ph_test_water_after_cleaning',
        'type',
        'created_at'
    ];

    /**
     * Flash messages for the model.
     *
     * @var array
     */
    protected array $flashMessages = [
        'create' => [
            'success' => "Le nettoyage n°<b>%s</b> a été créé avec succès !",
            'danger' => "Une erreur s'est produite lors de la création du nettoyage !"
        ],
        'update' => [
            'success' => "Le nettoyage n°<b>%s</b> a été édité avec succès !",
            'danger' => "Une erreur s'est produite lors de l'édition du nettoyage !"
        ],
        'delete' => [
            'success' => "<b>%s</b> nettoyage(s) ont été supprimé(s) avec succès !",
            'danger' => "Une erreur s'est produite lors de la suppression des nettoyages !"
        ]
    ];

    /**
     * The model used in the component.
     *
     * @var Cleaning
     */
    public Cleaning $model;

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
     * Translated attribute used in failed messages.
     *
     * @var string[]
     */
    protected $validationAttributes = [
        'material_id' => 'matériel',
        'ph_test_water' => 'Test PH d\'eau',
        'ph_test_water_after_cleaning' => 'Test PH d\'eau après nettoyage'
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
            'model.material_id' => 'required|exists:materials,id',
            'model.description' => 'nullable',
            'model.type' => 'required|in:' . collect(Cleaning::TYPES)->keys()->implode(','),
            'model.ph_test_water' => [
                Rule::requiredIf(function () {
                    return $this->model->type == 'weekly' &&
                    $this->materialCleaningTestPhEnabled == true;
                }),
                'numeric',
                'between:0,14',
                'nullable'
            ],
            'model.ph_test_water_after_cleaning' => [
                Rule::requiredIf(function () {
                    return $this->model->type == 'weekly' &&
                    $this->materialCleaningTestPhEnabled == true;
                }),
                'numeric',
                'between:0,14',
                'nullable'
            ],
        ];
    }

    /**
     * Create a blank model and return it.
     *
     * @return Cleaning
     */
    public function makeBlankModel(): Cleaning
    {
        $model = Cleaning::make();
        $model->type = $model->type ?? 'daily';

        return $model;
    }

    /**
     * Get the cleaning_test_ph_enabled for the selected material.
     *
     * @return void
     */
    public function updatedModel(): void
    {
        $material = Material::find($this->model->material_id);
        $this->materialCleaningTestPhEnabled = is_null($material) ? false : (bool)$material->cleaning_test_ph_enabled;
    }

    /**
     * Function to render the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.cleanings', [
            'cleanings' => $this->rows,
            //'materials' => Material::pluck('name', 'id')->toArray(),
            'materials' => Material::query()
                ->with(['zone' => function ($query) {
                    $query->select('id', 'name');
                }])
                ->select('id', 'name', 'zone_id')
                ->orderBy('zone_id')
                ->get()
                ->toArray(),
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
        $query = Cleaning::query()
            ->with('material', 'user', 'material.zone')
            ->when($this->filters['type'], fn($query, $type) => $query->where('type', $type))
            ->when($this->filters['creator'], fn($query, $creator) => $query->where('user_id', $creator))
            ->when($this->filters['material'], fn($query, $material) => $query->where('material_id', $material))
            ->when($this->filters['zone'], function ($query, $zone) {
                return $query->whereHas('material', function ($partQuery) use ($zone) {
                    $partQuery->where('zone_id', $zone);
                });
            })
            ->when($this->filters['ph-test-water-min'], fn($query, $ph) => $query->where('ph_test_water', '>=', $ph))
            ->when($this->filters['ph-test-water-max'], fn($query, $ph) => $query->where('ph_test_water', '<=', $ph))
            ->when($this->filters['ph-test-water-after-cleaning-min'], fn($query, $ph) => $query->where('ph_test_water_after_cleaning', '>=', $ph))
            ->when($this->filters['ph-test-water-after-cleaning-max'], fn($query, $ph) => $query->where('ph_test_water_after_cleaning', '<=', $ph))
            ->when($this->filters['created-min'], fn($query, $date) => $query->where('created_at', '>=', Carbon::parse($date)))
            ->when($this->filters['created-max'], fn($query, $date) => $query->where('created_at', '<=', Carbon::parse($date)))
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
        $this->authorize('create', Cleaning::class);

        $this->isCreating = true;
        $this->useCachedRows();

        // Reset the model to a blank model before showing the creating modal.
        if ($this->model->getKey()) {
            $this->model = $this->makeBlankModel();
        }
        $this->showModal = true;
    }

    /**
     * Set the model (used in modal) to the cleaning we want to edit.
     *
     * @param Cleaning $cleaning The cleaning id to update.
     * (Livewire will automatically fetch the model by the id)
     *
     * @return void
     */
    public function edit(Cleaning $cleaning): void
    {
        $this->authorize('update', Cleaning::class);

        $this->isCreating = false;
        $this->useCachedRows();

        // Set the model to the cleaning we want to edit.
        if ($this->model->isNot($cleaning)) {
            $this->model = $cleaning;
            $this->materialCleaningTestPhEnabled = $this->model->material->cleaning_test_ph_enabled;
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
        $this->authorize($this->isCreating ? 'create' : 'update', Cleaning::class);

        $this->validate();

        if ($this->model->type !== 'weekly' || $this->materialCleaningTestPhEnabled === false) {
            $this->model->ph_test_water = null;
            $this->model->ph_test_water_after_cleaning = null;
        }

        if ($this->model->save()) {
            $this->fireFlash($this->isCreating ? 'create' : 'update', 'success', '', [$this->model->getKey()]);
        } else {
            $this->fireFlash($this->isCreating ? 'create' : 'update', 'danger');
        }
        $this->showModal = false;
    }

    /**
     * Export the rows from last week to an Excel file with formatted content.
     *
     * @return StreamedResponse
     *
     * @throws IOException
     * @throws InvalidSheetNameException
     * @throws InvalidArgumentException
     * @throws WriterNotOpenedException
     */
    public function exportLastWeek(): StreamedResponse
    {
        $this->authorize('export', Cleaning::class);

        $fileName = 'nettoyages.xlsx';

        $options = new Options();
        $options->DEFAULT_COLUMN_WIDTH = 15;
        $options->DEFAULT_ROW_HEIGHT = 25;
        $options->setColumnWidth(6, 1);
        $options->setColumnWidth(30, 2);
        $options->setColumnWidth(20, 3);
        $options->setColumnWidth(65, 4);
        $writer = new Writer($options);
        $writer->openToBrowser($fileName);
        $writer->getCurrentSheet()->setName('Nettoyages');

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

        // FICHE NETTOYAGES
        $style = (new Style())
            ->setFontSize(24)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
            ->setBorder($border);

        $options->mergeCells(0, 2, 8, 2, 0);

        $row = Row::fromValues(['Fiche de Nettoyage', '', '', '', '', '', '', '', ''], $style);
        $row->setHeight(45);
        $writer->addRow($row);

        // SEMAINE XX-XX-XXXX au XX-XX-XXXX
        $style = (new Style())
            ->setFontSize(24)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
            ->setBorder($border);

        $options->mergeCells(0, 3, 8, 3, 0);

        $title = 'Du ' . Carbon::now()->subWeek()->startOfWeek()->format('d-m-Y') . ' au ' . Carbon::now()->subWeek()->endOfWeek()->format('d-m-Y');

        $row = Row::fromValues([$title, '', '', '', '', '', '', '', ''], $style);
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
            Cell::fromValue('Zone'),
            Cell::fromValue('Description'),
            Cell::fromValue('Créateur'),
            Cell::fromValue('Test PH de l\'eau'),
            Cell::fromValue('Test PH de l\'eau après nettoyage'),
            Cell::fromValue('Type'),
            Cell::fromValue('Créé le')
        ];
        $row = new Row($cells, $style);
        $row->setHeight(65);
        $writer->addRow($row);

        Cleaning::query()
        ->select(['id', 'material_id', 'user_id', 'description', 'ph_test_water', 'ph_test_water_after_cleaning', 'type', 'created_at'])
        ->with(['user', 'material', 'material.zone'])
        ->orderBy('type', 'desc')
        ->orderBy('created_at')
        ->whereDate('created_at', '>=', Carbon::now()->subWeek()->startOfWeek())
        ->whereDate('created_at', '<=', Carbon::now()->subWeek()->endOfWeek())
        ->chunk(2000, function (Collection $cleanings) use ($writer, $options) {
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

            $styleWeekly = (new Style())
                ->setFontSize(24)
                ->setCellAlignment(CellAlignment::CENTER)
                ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
                ->setBorder($border);

            $addedCasualRaw = false;
            $addedQuarterlyRaw = false;
            $addedMonthlyRaw = false;
            $addedWeeklyRaw = false;
            $addedDailyRaw = false;

            $dailyRow = collect();
            $dailyIds = collect([
                80, // CXT Moteur vis
                83, // CXT Filière
                84, // CXT P38 Granulateur/Couteau
                85, // CXT P39 Convoyeur Pneumatique
                87, // CXT P41 Tapis Vibrant
                137 // Sol Salle Blanche
            ]);

            $rowCount = 5;

            foreach ($cleanings as $cleaning) {
                if ($cleaning->type == 'daily' && $addedDailyRaw === false) {
                    $options->mergeCells(0, $rowCount, 8, $rowCount, 0);

                    $row = Row::fromValues(['Nettoyage Journalier', '', '', '', '', '', '', '', ''], $styleWeekly);
                    $row->setHeight(35);
                    $writer->addRow($row);

                    $addedDailyRaw = true;

                    $rowCount++;
                }

                if ($cleaning->type == 'weekly' && $addedWeeklyRaw === false) {
                    $options->mergeCells(0, $rowCount, 8, $rowCount, 0);

                    $row = Row::fromValues(['Nettoyage Hebdomadaire', '', '', '', '', '', '', '', ''], $styleWeekly);
                    $row->setHeight(35);
                    $writer->addRow($row);

                    $addedWeeklyRaw = true;

                    $rowCount++;
                }

                if ($cleaning->type == 'monthly' && $addedMonthlyRaw === false) {
                    $options->mergeCells(0, $rowCount, 8, $rowCount, 0);

                    $row = Row::fromValues(['Nettoyage Mensuel', '', '', '', '', '', '', '', ''], $styleWeekly);
                    $row->setHeight(35);
                    $writer->addRow($row);

                    $addedMonthlyRaw = true;

                    $rowCount++;
                }

                if ($cleaning->type == 'quarterly' && $addedQuarterlyRaw === false) {
                    $options->mergeCells(0, $rowCount, 8, $rowCount, 0);

                    $row = Row::fromValues(['Nettoyage Trimestrielle', '', '', '', '', '', '', '', ''], $styleWeekly);
                    $row->setHeight(35);
                    $writer->addRow($row);

                    $addedQuarterlyRaw = true;

                    $rowCount++;
                }

                if ($cleaning->type == 'casual' && $addedCasualRaw === false) {
                    $options->mergeCells(0, $rowCount, 8, $rowCount, 0);

                    $row = Row::fromValues(['Nettoyage Occasionnel', '', '', '', '', '', '', '', ''], $styleWeekly);
                    $row->setHeight(35);
                    $writer->addRow($row);

                    $addedCasualRaw = true;

                    $rowCount++;
                }

                $cells = [
                    Cell::fromValue($cleaning->id, $style),
                    Cell::fromValue($cleaning->material->name, $style),
                    Cell::fromValue($cleaning->material->zone->name, $style),
                    Cell::fromValue($cleaning->description, $style),
                    Cell::fromValue($cleaning->user->username, $style),
                    Cell::fromValue($cleaning->ph_test_water, $style),
                    Cell::fromValue($cleaning->ph_test_water_after_cleaning, $style),
                    Cell::fromValue(Cleaning::TYPES[$cleaning->type], $style),
                    Cell::fromValue(
                        $cleaning->created_at->format('d-m-Y H:i'),
                        (new Style())->setFormat('d-m-Y H:i')
                            ->setCellAlignment(CellAlignment::LEFT)
                            ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
                            ->setBorder($border)
                    )
                ];

                $row = new Row($cells);
                $writer->addRow($row);

                $rowCount++;


                // If type is daily and the material id is not isset, than add the material id to the collection.
                if ($cleaning->type == 'daily' && !isset($dailyRow[$cleaning->material->id])) {
                    $dailyRow->push($cleaning->material->id);
                }

                // If type is daily and both array are the same, that means we has written all entries for the cleaning daily and must add a blank row.
                if ($cleaning->type == 'daily' && $dailyRow->sortDesc()->values()->all() == $dailyIds->sortDesc()->values()->all()) {
                    $options->mergeCells(0, $rowCount, 8, $rowCount, 0);

                    $row = Row::fromValues(['', '', '', '', '', '', '', '', ''], $styleWeekly);
                    $row->setHeight(35);
                    $writer->addRow($row);

                    $rowCount++;

                    // Reset collection
                    $dailyRow = collect();
                }
            }

            flush();
        });

        return response()->streamDownload(function () use ($writer) {
                $writer->close();
        }, $fileName);
    }

    /**
     * Export the selected rows to an Excel file with formatted content.
     *
     * @return StreamedResponse
     *
     * @throws IOException
     * @throws InvalidArgumentException
     * @throws WriterNotOpenedException
     * @throws InvalidSheetNameException
     */
    public function exportSelected(): StreamedResponse
    {
        $this->authorize('export', Cleaning::class);

        $fileName = 'nettoyages.xlsx';

        $options = new Options();
        $options->DEFAULT_COLUMN_WIDTH = 15;
        $options->DEFAULT_ROW_HEIGHT = 25;
        $options->setColumnWidth(6, 1);
        $options->setColumnWidth(30, 2);
        $options->setColumnWidth(20, 3);
        $options->setColumnWidth(65, 4);
        $writer = new Writer($options);
        $writer->openToBrowser($fileName);
        $writer->getCurrentSheet()->setName('Nettoyages');

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

        $row = Row::fromValues(['Fiches Nettoyages', '', '', '', '', '', '', '', ''], $style);
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
            Cell::fromValue('Zone'),
            Cell::fromValue('Description'),
            Cell::fromValue('Créateur'),
            Cell::fromValue('Test PH de l\'eau'),
            Cell::fromValue('Test PH de l\'eau après nettoyage'),
            Cell::fromValue('Type'),
            Cell::fromValue('Créé le')
        ];
        $row = new Row($cells, $style);
        $row->setHeight(65);
        $writer->addRow($row);

        Cleaning::query()->whereKey($this->selectedRowsQuery->get()->pluck('id')->toArray())
        ->select(['id', 'material_id', 'user_id', 'description', 'ph_test_water', 'ph_test_water_after_cleaning', 'type', 'created_at'])
        ->with(['user', 'material', 'material.zone'])
        ->orderBy($this->sortField, $this->sortDirection)
        ->chunk(2000, function (Collection $cleanings) use ($writer) {
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

            foreach ($cleanings as $cleaning) {
                    $cells = [
                        Cell::fromValue($cleaning->id, $style),
                        Cell::fromValue($cleaning->material->name, $style),
                        Cell::fromValue($cleaning->material->zone->name, $style),
                        Cell::fromValue($cleaning->description, $style),
                        Cell::fromValue($cleaning->user->username, $style),
                        Cell::fromValue($cleaning->ph_test_water, $style),
                        Cell::fromValue($cleaning->ph_test_water_after_cleaning, $style),
                        Cell::fromValue(Cleaning::TYPES[$cleaning->type], $style),
                        Cell::fromValue(
                            $cleaning->created_at->format('d-m-Y H:i'),
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
     * Generate the cleaning plan and export rows to an Excel file with formatted content.
     *
     * @return StreamedResponse
     *
     * @throws IOException
     * @throws InvalidArgumentException
     * @throws WriterNotOpenedException
     * @throws InvalidSheetNameException
     */
    public function generateCleaningPlan(): StreamedResponse
    {
        $this->authorize('generatePlan', Cleaning::class);

        $fileName = 'plan-de-nettoyage.xlsx';

        $options = new Options();
        $options->DEFAULT_COLUMN_WIDTH = 15;
        $options->DEFAULT_ROW_HEIGHT = 25;
        $options->setColumnWidth(6, 1);
        $options->setColumnWidth(25, 2);
        $options->setColumnWidth(55, 3);
        $writer = new Writer($options);
        $writer->openToBrowser($fileName);
        $writer->getCurrentSheet()->setName('Plan de Nettoyage');


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

        $options->mergeCells(0, 1, 7, 1, 0);

        $row = Row::fromValues(['SELVAH', '', '', '', '', '', '', ''], $style);
        $row->setHeight(65);
        $writer->addRow($row);

        // MATERIELS
        $style = (new Style())
            ->setFontSize(24)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
            ->setBorder($border);

        $options->mergeCells(0, 2, 7, 2, 0);

        $row = Row::fromValues(['Plan de Nettoyage', '', '', '', '', '', '', ''], $style);
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
            Cell::fromValue('Nom du Matériel'),
            Cell::fromValue('Description'),
            Cell::fromValue('Zone'),
            Cell::fromValue('Fréquence de Nettoyage'),
            Cell::fromValue('Alerte par Email'),
            Cell::fromValue('Test PH obligatoire'),
            Cell::fromValue('Dernier Nettoyage'),
        ];
        $row = new Row($cells, $style);
        $row->setHeight(65);
        $writer->addRow($row);

        Material::query()
            ->select([
                'id',
                'name',
                'description',
                'zone_id',
                'cleaning_test_ph_enabled',
                'cleaning_alert',
                'cleaning_alert_email',
                'cleaning_alert_frequency_repeatedly',
                'cleaning_alert_frequency_type',
                'last_cleaning_at',
                'created_at'
            ])
            ->where('cleaning_alert', '=', true)
            ->with(['zone'])
            ->orderBy('cleaning_alert_frequency_type')
            ->orderBy('cleaning_alert_frequency_repeatedly')
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
                        Cell::fromValue($material->description, $style),
                        Cell::fromValue($material->zone->name, $style),
                        Cell::fromValue("Tout les $material->cleaning_alert_frequency_repeatedly " . Material::CLEANING_TYPES[$material->cleaning_alert_frequency_type], $style),
                        Cell::fromValue($material->cleaning_alert_email ? "Oui" : "Non", $style),
                        Cell::fromValue($material->cleaning_test_ph_enabled ? "Oui" : "Non", $style),
                        Cell::fromValue($material->last_cleaning_at?->format('d-m-Y H:i'), $style)
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
}
