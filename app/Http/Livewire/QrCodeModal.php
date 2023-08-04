<?php

namespace Selvah\Http\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Selvah\Models\Material;
use Selvah\Models\Part;
use Symfony\Component\HttpFoundation\RedirectResponse as HttpFoundationRedirectResponse;

class QrCodeModal extends Component
{
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
            'actions' => [
                'incidents' => 'Incident',
                'maintenances' => 'Maintenance'
            ]
        ],
        'part' => [
            'actions' => [
                'part-entries' => 'Entrée de pièce',
                'part-exits' => 'Sortie de pièce'
            ]
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
    public string $type;

    /**
     * The model related to the action, part or material.
     *
     * @var \Selvah\Models\Material|\Selvah\Models\Part
     */
    public Material|Part $model;

    /**
     * Rules used for validating the model.
     *
     * @return string[]
     */
    protected function rules()
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
        if (request('qrcode') == true && array_key_exists(request('type'), $this->types)) {
            $this->type = request('type');

            if ($this->type == 'material') {
                $this->model = Material::findOrFail(request('id'));
            }

            if ($this->type == 'part') {
                $this->model = Part::findOrFail(request('id'));
            }

            // Increment the flash_count for the model.
            $this->model->qrcode_flash_count++;
            $this->model->save();

            $this->select();
        }
    }

    /**
     * Function to render the component.
     *
     * @return View
     */
    public function render()
    {
        return view('livewire.qr-code-modal');
    }

    /**
     * Function to show the QR Code modal.
     *
     * @return void
     */
    public function select()
    {
        $this->showQrCodeModal = true;
    }

    /**
     * Redirect the user regarding to his choice.
     *
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function redirection()
    {
        $this->validate();

        if (in_array($this->action, array_keys($this->types[$this->type]['actions']))) {
            return redirect()
                ->route($this->action . '.index', ['qrcodeid' => $this->model->getKey(), 'qrcode' => 'true']);
        }

        $this->showQrCodeModal = false;
    }
}
