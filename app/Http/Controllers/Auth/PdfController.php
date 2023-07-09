<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Testlist;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{
    //
    public function pdfCreate ($id)
    {
        $today = date('Y/m/d');
        $params = Testlist::find($id);
        $pdf = PDF::loadView('result.pdf',compact('params','today'));
        return $pdf->stream("result.pdf");
    }
}
