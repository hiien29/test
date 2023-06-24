<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\Testlist;
use App\Models\Result;

class TestController extends Controller
{
    //
    public function create(): View
    {
        $params = Testlist::where('test_day','>',today())
        ->orderBy('test_day', 'asc')
        ->orderBy('age')
        ->get();
        return view('admin.test_schedule',compact('params'));
    }

    public function test(): View
    {
        $params = Testlist::where('test_day','=',today())
        ->whereNull('result')
        ->orderBy('age')
        ->get();

        $count = $params->count(); 

        return view('admin.test',compact('params','count'));
    }

    public function result(): View
    {
        $params = Testlist::whereNotNull('result')
        ->get();
        return view('admin.test_result',compact('params'));
    }

}