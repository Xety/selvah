<?php

namespace Selvah\Http\Controllers;

use Illuminate\Http\Request;
use Selvah\Models\Maintenance;
use Selvah\Models\Material;
use Selvah\Models\Part;

class QrCodeController extends Controller
{
    protected $type = [
        'maintenances',
        'part-exits'
    ];

    public function show(string $type, int $id)
    {
        if (!in_array($type, $this->type)) {
            abort(404);
        }
        $materiel = Material::findOrFail($id);

        if ($type === 'maintenances') {
            return redirect()->route('maintenances.index', ['id' => $materiel->id, 'qrcode' => 'true']);
        }

        if ($type === 'part-exits') {
            $part = Part::findOrFail($id);

            return redirect()->route('part-exits.index', ['id' => $part->id, 'qrcode' => 'true']);
        }
    }
}
