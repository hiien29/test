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


class TestResultController extends Controller
{
    
    public function edit($id)
    {
        $params = Testlist::find($id);
        return view('admin.result.edit', compact('params'));
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
            'test_editor' => 'required',
            'result' =>  'required',
            'comment' => 'required'
        ]);

        $params['comment'] = $data->comment . PHP_EOL. $params['comment'];


        $data->update($params);
        return redirect()->route('admin.result');
    }

    public function delete($id)
    {
        $data = Testlist::find($id);
        $data->delete();
        return redirect()->route('admin.result');
        
    }

    public function detail($id)
    {
        $details = Testlist::find($id);
        return view('admin.result.detail',compact('details'));
    }

    
    public function search(Request $request)
    {
        $results = Testlist::whereNotNull('result');

        if(isset($request->start_day) && isset($request->end_day))
        {
            $results->whereBetween('test_day',[$request->start_day,$request->end_day]);
        }
        if(isset($request->type))
        {
            $results->where('type',$request->type);
        }
        if(isset($request->age))
        {
            $results->where('age',$request->age);
        }
        if (isset($request->site)) 
        {
            $results->where('site', $request->site );
        }

        if (!isset($request->start_day) && !isset($request->end_day) && !isset($request->type) && !isset($request->age) && !isset($request->site)) {
            $results->whereRaw('1 = 0');
        }

        $searches = $results->paginate(10);

        $count = $results->count();

        $avg = $searches->avg('result');
        $min = $searches->min('result');
        $max = $searches->max('result');

        return view('admin.result.index',compact('searches','avg','request','count','min','max'));
    }
}
