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
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Redirect;

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

    

    public function search(Request $rq)
    {
        $query = Testlist::query();
        $query->whereNotNull('result')->orderBy('test_day','desc')->orderBy('age');

        $start_day = $rq->input('start_day');
        $end_day = $rq->input('end_day');
        $type = $rq->input('type');
        $age = $rq->input('age');
        $site = $rq->input('site');

        
        if(isset($start_day) && isset($end_day))
        {
            $query->whereBetween('test_day',[$start_day,$end_day]);
        }

        if(isset($type))
        {
            $query->where('type',$type);
        }

        if(isset($age))
        {
            $query->where('age',$age);
        }
        if(isset($site))
        {
            $query->where('site',$site);
        }

        if (!isset($start_day) && !isset($end_day) && !isset($type) && !isset($age) && !isset($site)) {
            $query->whereRaw('1 = 0');
        }


        $results = $query->get();
        $avg = $results->avg('result');
        $min = $results->min('result');
        $max = $results->max('result');
        $searches = $query->paginate(10);
        

        return view('admin.result.index',compact('searches','rq','avg','min','max'));
    }
}
        // if(isset($request->start_day) && isset($request->end_day))
        // {
        //     $results->whereBetween('test_day',[$request->start_day,$request->end_day]);
            
        // }
        // if(isset($request->type))
        // {
        //     $results->where('type',$request->type);
            
        // }
        // if(isset($request->age))
        // {
        //     $results->where('age',$request->age);
            
        // }
        // if (isset($request->site)) 
        // {
        //     $results->where('site', $request->site );
        //     $request->session()->put('site',$request->input('site'));
        // }

        // if (!isset($request->start_day) && !isset($request->end_day) && !isset($request->type) && !isset($request->age) && !isset($request->site)) {
        //     $results->whereRaw('1 = 0');
        // }

        
        // $searches =$results->paginate(10)->appends($request->except('page'));


        // $count = $results->count();

        // $avg = $results->avg('result');
        // $min = $results->min('result');
        // $max = $results->max('result');

// dd($searches);
        // return view('admin.result.index',compact('searches','avg','request','count','min','max'));
        // return view('admin.result.index',compact('searches'));
        // return view('admin.result.index');
    // }

    // public function search(Request $rq)
    // {
    //     $query = Testlist::query();
    //     $query->whereNotNull('result');

    //     $start_day = $rq->input('start_day');
    //     $end_day = $rq->input('end_day');
    //     $type = $rq->input('type');
    //     $age = $rq->input('age');
    //     $site = $rq->input('site');

    //     if(isset($start_day) && isset($end_day))
    //     {
    //         $query->whereBetween('test_day',[$start_day,$end_day]);
    //     }

    //     if(isset($type))
    //     {
    //         $query->where('type',$type);
    //     }

    //     if(isset($age))
    //     {
    //         $query->where('age',$age);
    //     }
    //     if(isset($site))
    //     {
    //         $query->where('site',$site);

    //     }

    //     $searches = $query->paginate(10);

    //     $avg = $query->avg('result');
    //     $min = $query->min('result');
    //     $max = $query->max('result');

    //     return view('admin.result.search',compact('searches','avg','min','max'));
    // }

