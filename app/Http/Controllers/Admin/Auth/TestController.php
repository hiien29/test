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

class TestController extends Controller
{
    //
    public function create(): View
    {
        $contacts = Testlist::where('test_day','>',today())
        ->orderBy('test_day', 'asc')
        ->get();
        return view('admin.test_schedule',compact('contacts'));
    }

    public function test(): View
    {
        return view('admin.test');
    }
    public function result(): View
    {
        return view('admin.test_result');
    }

    // public function testadd(): View
    // {
    //     return view('admin.test_register');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'make_day' => 'required', 
    //         'test_day' => 'required',
    //         'age' => 'required', 
    //         'type' => 'required',
    //         'site' => 'required',
    //         'author' => 'required',
    //     ]);
    //     Testlist::create([
    //         'make_day' => $request->make_day,
    //         'test_day' => $request->test_day,
    //         'age' => $request->age,
    //         'type' => $request->type,
    //         'site' => $request->site,
    //         'author' => $request->author,
    //         'created_at' => now(),
    //         'updated_at' => now()
    //     ]);
        
    //     return redirect(route('admin.schedule'));

    // }
}
