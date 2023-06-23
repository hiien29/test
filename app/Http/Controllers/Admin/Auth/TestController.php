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
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use Carbon\Carbon;

class TestController extends Controller
{
    //
    public function create(): View
    {
        $params = Testlist::where('test_day','>',today())
        ->orderBy('test_day', 'asc')
        ->get();
        return view('admin.test_schedule',compact('params'));
    }

    public function test(): View
    {
        $params = Testlist::where('test_day','=',today())->get();
        /
        $today = Carbon::today();

$params = Testlist::join('results', 'testlists.id', '=', 'results.testlist_id')
    ->select('testlists.*', 'results.result as result')
    ->whereDate('testlists.test_day', $today)
    ->whereNull('results.result')
    ->get();

// dd($params);
return view('admin.test',compact('params'));
    }

    public function result(): View
    {
        return view('admin.test_result');
    }

}