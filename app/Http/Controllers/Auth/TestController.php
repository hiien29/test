<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Testlist;

class TestController extends Controller
{
    
    public function create(): View
    {
        $params = Testlist::where('test_day','>',today())
        ->orderBy('test_day', 'asc')
        ->orderBy('age')
        ->paginate(10);
        return view('schedule.index',compact('params'));
    }

    public function test(): View
    {
        $params = Testlist::where('test_day','=',today())
        ->whereNull('result')
        ->orderBy('age')
        ->paginate(10);

        $count = Testlist::where('test_day','=',today())
        ->whereNull('result')
        ->count();  

        $nottasks = Testlist::where('test_day','<',today())
        ->whereNull('result')
        ->orderBy('test_day','asc')
        ->get();

        return view('task.index',compact('params','count','nottasks'));
    }

    public function result(): View
    {
        $params = Testlist::whereNotNull('result')
        ->orderBy('test_day','desc')
        ->orderBy('age')
        ->paginate(10);
        
        return view('result.index',compact('params'));
    }
}
