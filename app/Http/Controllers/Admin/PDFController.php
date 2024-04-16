<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    public function constancia(Request $request)
    {
        $id_fud = $request->id_reg_fud;

        $victima = DB::table('_padron_victima as v')
            ->where('id_reg_fud', '=', $id_fud)
            ->select('v.nombre_victima', 'v.primer_apellido', 'v.segundo_apellido', 'v.nomenclatura')
            ->first();
        $nombre = $victima->nombre_victima;
        $apellido1 = $victima->primer_apellido;
        $apellido2 = $victima->segundo_apellido;
        $nomenclatura = $victima->nomenclatura;

        $pdf = new TCPDF;

        $pdf::setHeaderCallback(function ($pdf) {
            //$pdf->Image(public_path('images/header_constancia.jpg'), 20, 15, 180, 17, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
            $pdf->Image(public_path('images/prueba4.jpg'), 0, 0, '','', '', '', '', false, 300, '', false, false, 0, false, false, false);
            
            /*$pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 0, '$title', 0, false, 'R', false, '', 0, false, 'T', 'M');
    $pdf->Ln();
    $pdf->SetFont('helvetica', 'R', 12);
    $pdf->Cell(0, 0.22, '$subtitle', 0, false, 'R', false, '', 0, false, 'T', 'B');*/
        });
        TCPDF::setFooterCallback(function ($pdf) {
            // Image(string file [, float x [, float y [, float w [, float h [, string type [, mixed link]]]]]])
            $pdf->Image(public_path('images/foo2.jpg'), 0, 266, 218, 30,'', '', 'T', false, 300, '', false, false, 0, false, false, false);
        });

        // set font

        $pdf::SetTitle('COMISION EJECUTIVA ESTATAL DE ATENCION INTEGRAL A VICTIMAS');



        $pdf::AddPage();
        //$pdf::Write(70, 'COMISIÓN EJECUTIVA ESTATAL DE ATENCIÓN');
        //$pdf::Write(71,'INTEGRAL A VÍCTIMAS');

        // Set some content to print
        // $fontname = $pdf::AddTTFFont('../vendor/elibyy/tcpdf-laravel/src/Fonts/Montserrat/Montserrat-Regular.otf');

        setlocale(LC_TIME, 'es_ES');
        $dia = date('d');
        date_default_timezone_set("America/Mexico_City");
        $mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];
        $anio = date('Y');

        //$pdf::getfontpath('../vendor/elibyy/tcpdf-laravel/src/Fonts/Montserrat');
        // $pdf::AddTTFFont('../vendor/elibyy/tcpdf-laravel/src/Fonts/Montserrat/Montserrat-Regular.otf','TrueType','',3,false,false);
        // $pdf::SetFont('helvetica', '', '');
        $pdf::SetXY(10, 50);
        //$pdf::SetMargins(15,'',-1);

        $html = <<<EOD
<html>
<head>
<style>


  
@font-face {
    font-family: 'Roboto';
    src: url('../storage/fonts/RobotoCondensed-Regular.ttf');
}

    .roboto {
        font-family: 'Roboto', sans-serif;
    }

</style>
</head>
<body >
<div>
<p align="center" style="font-size:18px;" class="roboto"><b>COMISIÓN EJECUTIVA ESTATAL DE ATENCIÓN<br>
INTEGRAL A VÍCTIMAS</b></p>
<p align="center" style="font-size: 12px;font: weight 100px;" class="roboto">REGISTRO ESTATAL DE VÍCTIMAS DEL ESTADO DE OAXACA</p>
<!--<p align="right" style="font-size: 12px;font: weight 100px;" class="roboto">Expediente Número:<br><b>CEEAV/OAX/CIE/34/2024</b><br>Número de Registro:<br><b>$nomenclatura.</b></p>-->
<p align="right" style="font-size: 12px;font: weight 100px;" class="roboto"><br>Número de Registro:<br><b>$nomenclatura.</b></p>
<p align="right" style="font-size: 12px;font: weight 100px;" class="roboto">Oaxaca de Juárez, Oaxaca, a $dia de $mes de $anio. </b></p>

<p align="center" style="font-size:20px;" class="roboto"><b>CONSTANCIA DE REGISTRO</b></p>

<p align="justify" style="font-size:12px;line: height 1.5;font: weight 100px;" class="roboto">Con fundamento en los articulos 1 y 8 apartado C de la Constitución Politica del Estado Libre y Soberano de Oaxaca;
1, 2, 4, 5, 7, 44, 84, 94, 95, 101 y 107 de Ley de Víctimas del Estado de Oaxaca, se <b>HACE CONSTAR</b> que conforme al Acuerdo de Inscripción emitido en el expediente en que se actúa, <b>$nombre $apellido1 $apellido2</b> ha quedado formalmente inscrito en el Registro Estatal de Víctimas de Oaxaca, con la calidad de <b>VÍCTIMA DIRECTA DEL DELITO/ DE VIOLACIONES A DERECHOS HUMANOS</b>, correspondiéndole el folio número <b>$nomenclatura</b>.
<br><br>
Finalmente, se establece que la presente constancia surte los efectos de la confidencialidad y reserva de los datos personales conforme a las disposiciones jurídicas aplicables.</p>
</div>

<div>
<p align="center" style="font-size:12px;line-height: 1.5;font: weight 100px;" class="roboto"><b>Alfredo Orozco Escobar</b><br>
Jefe del Departamento del Registro Estatal de Víctimas<br>
de la Comisión Ejecutiva Estatal de Atención<br>
Integral a Víctimas</p>
</div>
</body>
</html>

EOD;


        //$pdf::writeHTML($html,true,false,false,false,'');

        // Print text using writeHTMLCell()

        $pdf::writeHTMLCell(0, 0, 20, 30, $html, 0, 1, 0, true, '', true);

        // QRCODE,H : QR-CODE Best error correction
        $style = array(
            'border' => false,
            'padding' => 'auto',
            'fgcolor' => array(157, 36, 73),
            'bgcolor' => false
        );
        $pdf::write2DBarcode('https://www.ceeavoaxaca.gob.mx/', 'QRCODE,H', 168, 230, 30, 30, $style, 'N');
        //$pdf::Text(80, 205, 'QRCODE H - COLORED');

        // new style

        $pdf::Output('Constancia.pdf');
    }
}
