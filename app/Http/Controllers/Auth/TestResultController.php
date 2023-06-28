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
use App\Models\Result;


class TestResultController extends Controller
{
    //未編集
    public function edit($id)
    {
        $params = Testlist::find($id);
        return view('result.edit', compact('params'));
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
        return redirect()->route('result');
    }

    public function delete($id)
    {
        $data = Testlist::find($id);
        $data->delete();
        return redirect()->route('result');
        
    }

    public function detail($id)
    {
        $details = Testlist::find($id);
        return view('result.detail',compact('details'));
    }
}
