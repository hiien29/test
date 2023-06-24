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


class TestTaskController extends Controller
{
    
    public function show($id)
    {
        $data = Testlist::find($id);
        return view('admin.result_register',compact('data'));
    }

    public function register(Request $request,$id)
    {
        $data = Testlist::find($id);
        $params = $request->validate([
            'result' => 'required', 
            'tester' => 'required'
        ]);
        $data->update($params);
        return redirect()->route('admin.test');
    }
}
