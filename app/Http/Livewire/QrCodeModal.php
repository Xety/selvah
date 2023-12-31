<?php

namespace Selvah\Http\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Selvah\Models\Cleaning;
use Selvah\Models\Incident;
use Selvah\Models\Maintenance;
use Selvah\Models\Material;
use Selvah\Models\Part;
use Selvah\Models\PartEntry;
use Selvah\Models\PartExit;

class QrCodeModal extends Component
{
    use AuthorizesRequests;

    /**
     * Used to update in URL the query string.
     *
     * @var string[]
     */
    protected $queryString = [
        'type' => ['except' => ''],
        'qrcode' => ['except' => ''],
        'qrcodeid' => ['except' => '']
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
     * @var null|int
     */
    public null|int $qrcodeid = null;

    /**
     * Used to show the QR Code modal.
     *
     * @var bool
     */
    public bool $showQrCodeModal = false;

    /**
     * The type of the scanned QR Code with their actions
     *
     * @var array
     */
    public array $types = [
        'material' => [
            'actions' => []
        ],
        'part' => [
            'actions' => []
        ]
    ];

    /**
     * The action to do after the user has scanned the QR Code.
     *
     * @var string
     */
    public string $action = '';

    /**
     * The type of the action.
     *
     * @var string
     */
    public string $type = '';

    /**
     * The model related to the action, part or material.
     *
     * @var Material|Part|null
     */
    public Material|Part|null $model = null;

    /**
     * Rules used for validating the model.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'action' => 'required|in:' . collect($this->types[$this->type]['actions'])->keys()->implode(','),
        ];
    }

    /**
     * The Livewire Component constructor.
     *
     * @return void
     */
    public function mount(): void
    {
        // Material types
        if (Auth::user()->can('create', Incident::class)) {
            $this->types['material']['actions']['incidents'] = 'Incident';
        }
        if (Auth::user()->can('create', Maintenance::class)) {
            $this->types['material']['actions']['maintenances'] = 'Maintenance';
        }
        if (Auth::user()->can('create', Cleaning::class)) {
            $this->types['material']['actions']['cleanings'] = 'Nettoyage';
        }

        //  Part types
        if (Auth::user()->can('create', PartEntry::class)) {
            $this->types['part']['actions']['part-entries'] = 'Entrée de pièce';
        }
        if (Auth::user()->can('create', PartExit::class)) {
            $this->types['part']['actions']['part-exits'] = 'Sortie de pièce';
        }

        if ($this->qrcode === true && array_key_exists($this->type, $this->types) && $this->qrcodeid !== null) {
            if ($this->type == 'material' && Auth::user()->can('scanQrCode material')) {
                $this->model = Material::find($this->qrcodeid);
            }

            if ($this->type == 'part' && Auth::user()->can('scanQrCode part')) {
                $this->model = Part::find($this->qrcodeid);
            }

            if ($this->model !== null) {
                // Increment the flash_count for the model.
                $this->model->qrcode_flash_count++;
                $this->model->save();

                $this->select();
            }
        }
    }

    /**
     * Function to render the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.qr-code-modal');
    }

    /**
     * Function to show the QR Code modal.
     *
     * @return void
     */
    public function select(): void
    {
        $this->showQrCodeModal = true;
    }

    /**
     * Redirect the user regarding his choice.
     *
     * @return RedirectResponse|void
     */
    public function redirection()
    {
        $this->validate();

        if (in_array($this->action, array_keys($this->types[$this->type]['actions']))) {
            return redirect()
                ->route($this->action . '.index', ['qrcodeid' => $this->qrcodeid, 'qrcode' => 'true']);
        }

        $this->showQrCodeModal = false;
    }
}
