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
use Illuminate\Pagination\Paginator;
use App\Models\Result;

class TestController extends Controller
{
    //
    public function create(): View
    {
        $params = Testlist::where('test_day','>',today())
        ->orderBy('test_day', 'asc')
        ->orderBy('age')
        ->paginate(10);
        return view('admin.schedule.index',compact('params'));
    }

    public function test(): View
    {
        $params = Testlist::where('test_day','=',today())
        ->whereNull('result')
        ->orderBy('age')
        ->paginate(10);

        $nottasks = Testlist::where('test_day','<',today())
        ->whereNull('result')
        ->orderBy('test_day','asc')
        ->get();

        $count = Testlist::where('test_day','=',today())
        ->whereNull('result')
        ->count();

        return view('admin.task.index',compact('params','nottasks','count'));
    }

    public function result(): View
    {
        $params = Testlist::whereNotNull('result')
        ->orderBy('test_day','desc')
        ->orderBy('age')
        ->paginate(10);


        return view('admin.result.index',compact('params'));
    }

}