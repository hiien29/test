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
        return view('admin.schedule.index',compact('params'));
    }

    public function test(): View
    {
        $params = Testlist::where('test_day','=',today())
        ->whereNull('result')
        ->orderBy('age')
        ->get();

        $count = $params->count(); 

        $nottasks = Testlist::where('test_day','<',today())
        ->whereNull('result')
        ->orderBy('test_day','asc')
        ->get();

        return view('admin.task.index',compact('params','count','nottasks'));
    }

    public function result(): View
    {
        $params = Testlist::whereNotNull('result')
        ->orderBy('test_day','desc')
        ->get();
        return view('admin.result.index',compact('params'));
    }

}