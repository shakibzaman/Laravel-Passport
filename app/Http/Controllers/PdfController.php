<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class PdfController extends Controller
{
    public function pdf(){
    	$pdf=App::make('dompdf.wrapper');
    	$data='<h1>Hi This is  Shakib and it is a Pdf</h1>';
    	$pdf->loadHTML($data);
    	$pdf->download('itsolutionstuff.pdf');
    	return $pdf->stream();
    }
}
