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

class TestScheduleController extends Controller
{

    public function create(): View
    {
        return view('schedule.register');
    }


    public function store(Request $request)
    {
        $request->validate([
            'make_day' => 'required', 
            'test_day' => 'required',
            'age' => 'required', 
            'type' => 'required',
            'site' => 'required',
            'author' => 'required',
        ]);

        $testlist = [
            'make_day' => $request->make_day,
            'test_day' => $request->test_day,
            'age' => $request->age,
            'type' => $request->type,
            'site' => $request->site,
            'author' => $request->author,
            'created_at' => now(),
            'updated_at' => now()
        ];
        if($request->comment) {
            $testlist['comment'] = PHP_EOL.$request->comment.'（'.$request->author.' '.date("Y/m/d H:i:s").'）';
        }      
        Testlist::create($testlist);
        
        return redirect(route('testregister'))->with('message', '登録が完了しました。');
    }

    public function edit($id)
    {
        $params = Testlist::find($id);
        return view('schedule.edit', compact('params'));
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
        $params['comment'] = $data->comment . PHP_EOL. $params['comment'].'（'.$params['editor'].' '.date("Y/m/d H:i:s").'）';

        $data->update($params);
        return redirect()->route('schedule');
    }

    public function delete($id)
    {
        $data = Testlist::find($id);
        $data->delete();
        return redirect()->route('schedule');
    }

    public function detail($id)
    {
        $details = Testlist::find($id);
        return view('schedule.detail',compact('details'));
    }
}
