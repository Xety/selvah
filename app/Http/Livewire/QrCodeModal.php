<?php

namespace Selvah\Http\Livewire;

use Livewire\Component;
use Selvah\Models\Material;
use Selvah\Models\Part;

class QrCodeModal extends Component
{
    /**
     * Used to show the Edit/Create modal.
     *
     * @var bool
     */
    public bool $showQrCodeModal = false;

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

    public string $action = '';

    public string $type;

    public $model;

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

            $this->select();
        }
    }

    public function render()
    {
        return view('livewire.qr-code-modal');
    }

    public function select()
    {
        $this->showQrCodeModal = true;
    }

    public function redirection()
    {
        $this->validate();

        if ($this->action == 'maintenances') {
            return redirect()->route('maintenances.index', ['id' => $this->model->getKey(), 'qrcode' => 'true']);
        }

        if ($this->action == 'incidents') {
            return redirect()->route('incidents.index', ['id' => $this->model->getKey(), 'qrcode' => 'true']);
        }

        if ($this->action == 'part-entries') {
            return redirect()->route('part-entries.index', ['id' => $this->model->getKey(), 'qrcode' => 'true']);
        }

        if ($this->action == 'part-exits') {
            return redirect()->route('part-exits.index', ['id' => $this->model->getKey(), 'qrcode' => 'true']);
        }

        $this->showQrCodeModal = false;
    }
}
