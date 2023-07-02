<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Testlist;

class PdfController extends Controller
{
    //
    public function pdfCreate ($id)
    {

        $today = date('Y/m/d');
        $params = Testlist::find($id);
        $pdf = PDF::loadView('admin.result.pdf',compact('params','today'));
        return $pdf->stream("result.pdf");
    }
}
