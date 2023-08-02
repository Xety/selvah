<?php

namespace Selvah\Http\Livewire\Traits;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\OpenSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Selvah\Models\Material;

trait WithQrCode
{
    /**
     * The field to sort by.
     *
     * @var string
     */
    public string $qrcodeImg = '';

    public int $qrcodeSize = 200;

    public string $qrcodeLabel = '';

    public Material $modelQrCode;

    public bool $showQrCodeModal = false;

    public $allowedQrcodeSize = [
        100 => [
            'image_size' => 30,
            'text' => 'Très Petit',
            'font_size' => 8
        ],
        150 => [
            'image_size' => 40,
            'text' => 'Petit',
            'font_size' => 9
        ],
        200 => [
            'image_size' => 50,
            'text' => 'Normal',
            'font_size' => 10
        ],
        300 => [
            'image_size' => 50,
            'text' => 'Moyen',
            'font_size' => 12
        ],
        400 => [
            'image_size' => 70,
            'text' => 'Grand',
            'font_size' => 14
        ],
        500 => [
            'image_size' => 90,
            'text' => 'Très Grand',
            'font_size' => 17
        ]
    ];


    public function showQrCode($id)
    {
        $this->modelQrCode = Material::find($id);
        $this->qrcodeLabel = $this->modelQrCode->name;

        $result = $this->buildImage();
        $this->qrcodeImg = $result;

        $this->showQrCodeModal = true;
    }

    public function buildImage()
    {
        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data(route('dashboard.index', ['qrcode' => 'true', 'type' => 'material', 'id' => $this->modelQrCode->getKey()]))
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size($this->qrcodeSize)
            ->margin(0)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->logoPath(public_path('images/logos/selvah_600x600_fond_blanc_qrcode.png'))
            ->logoResizeToWidth($this->allowedQrcodeSize[$this->qrcodeSize]['image_size'])
            ->logoPunchoutBackground(true)
            ->labelText($this->qrcodeLabel)
            ->labelFont(new OpenSans($this->allowedQrcodeSize[$this->qrcodeSize]['font_size']))
            ->labelAlignment(new LabelAlignmentCenter())
            ->build();

        return $result->getDataUri();
    }

    public function generateQrcodeLabel(): void
    {
        $result = $this->buildImage();
        $this->qrcodeImg = $result;
    }

    public function updatedQrcodeSize(string $field): void
    {
        // Prevent user that update the HTML value to set a not allowed value.
        if (!array_key_exists($field, $this->allowedQrcodeSize)) {
            $this->qrcodeSize = 200;
        }

        $result = $this->buildImage();
        $this->qrcodeImg = $result;
    }
}
