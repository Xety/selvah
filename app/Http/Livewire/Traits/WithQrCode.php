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

    public $modelQrcode;

    public bool $showQrCodeModal = false;


    public function showQrCode($id)
    {
        $this->modelQrcode = Material::find($id);

        $this->qrcodeLabel = $this->modelQrcode->name;

        $result = $this->buildImage();
        $this->qrcodeImg = $result;


        $this->showQrCodeModal = true;
    }

    public function buildImage()
    {
        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data('https://selvah.xetaravel.com/maintenances')
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size($this->qrcodeSize)
            ->margin(0)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->logoPath(public_path('images/logos/selvah_600x600_fond_blanc_qrcode.png'))
            ->logoResizeToWidth(50)
            ->logoPunchoutBackground(true)
            ->labelText($this->qrcodeLabel)
            ->labelFont(new OpenSans(10))
            ->labelAlignment(new LabelAlignmentCenter())
            //->validateResult(false)
            ->build();

        return $result->getDataUri();
    }

    /**
     * Generate the slug assign it to the model.
     *
     * @return void
     */
    public function generateQrcodeSize(): void
    {
        $this->checkQrcodeSize();

        $result = $this->buildImage();
        $this->qrcodeImg = $result;
    }

    public function generateQrcodeLabel(): void
    {
        $result = $this->buildImage();
        $this->qrcodeImg = $result;
    }

    public function checkQrcodeSize(): void
    {
        if ($this->qrcodeSize < 150 || $this->qrcodeSize > 500) {
            $this->qrcodeSize = 200;
        }
    }
}
