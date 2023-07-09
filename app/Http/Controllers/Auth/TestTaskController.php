<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\Testlist;



class TestTaskController extends Controller
{
    
    public function show($id)
    {
        $data = Testlist::find($id);
        return view('task.register',compact('data'));
    }

    public function register(Request $request,$id)
    {
        $data = Testlist::find($id);
        $params = $request->validate([
            'result' => ['required','numeric'] ,
            'tester' => 'required'
        ]);
        $data->update($params);
        return redirect()->route('test');
    }

    public function edit($id)
    {
        $params = Testlist::find($id);
        return view('task.edit', compact('params'));
    }

    public function update(Request $request,$id)
    {
        $data = Testlist::find($id);
        $params = $request->validate([
            'make_day' => 'required', 
            'test_day' => 'required',
            'age' => 'required', 
            'type' => 'required',
            'site' => 'required',
            'editor' => 'required',
            'comment' => 'required'
        ]);
        $params['comment'] = $data->comment . PHP_EOL. $params['comment'];

        $data->update($params);
        return redirect()->route('test');
    }

    public function delete($id)
    {
        $data = Testlist::find($id);
        $data->delete();
        return redirect()->route('test');
        
    }

    public function detail($id)
    {
        $details = Testlist::find($id);
        return view('task.detail',compact('details'));
    }
}
