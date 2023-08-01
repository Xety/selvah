<?php

namespace Selvah\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SimpleXMLElement;


use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\OpenSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeController extends Controller
{
    public function show()
    {
        $data = QrCode::size(350)
            ->format('png')
            ->merge('/public/images/logos/selvah_600x600_fond_blanc_qrcode.png')
            ->errorCorrection('L')
            ->generate(
                'https://selvah.xetaravel.com/maintenances',
            );

        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data('https://selvah.xetaravel.com/maintenances')
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(200)
            ->margin(0)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->logoPath(__DIR__.'/../../../public/images/logos/selvah_600x600_fond_blanc_qrcode.png')
            ->logoResizeToWidth(50)
            ->logoPunchoutBackground(true)
            ->labelText('CXT P32 By-pass')
            ->labelFont(new OpenSans(10))
            ->labelAlignment(new LabelAlignmentCenter())
            //->validateResult(false)
            ->build();

        return response('<img src="' . $result->getDataUri() . '" />');
            //->header('Content-type', 'image/png');
    }
}
