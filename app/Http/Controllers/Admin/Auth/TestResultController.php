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
            // 'comment' => 'required'
        ]);

        // $params['comment'] = $data->comment . PHP_EOL. $params['comment'];


        $data->update($params);

        $searches = $request->session()->get('searches');
        if(isset($searches))
        {
            $query = Testlist::query();
            if (isset($searches['start_day']) && isset($searches['end_day'])) 
            {
                $query->whereBetween('test_day', [$searches['start_day'], $searches['end_day']]);
            }
            if (isset($searches['type'])) 
            {
                $query->where('type', $searches['type']);
            }
            if (isset($searches['age'])) 
            {
                $query->where('age', $searches['age']);
            }
            if (isset($searches['site'])) 
            {
                $query->where('site', $searches['site']);
            }
            $results = $query->get();
            $avg = $results->avg('result');
            $min = $results->min('result');
            $max = $results->max('result');
            $searches = $query->paginate(10);
            $session = $request->session()->get('searches');
            return view('admin.result.index')->with(compact('searches','session','avg','min','max','request'));
        }
        else
        {
        return redirect()->route('admin.result');
        }
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
            $query->where('site','like','%'.$site.'%');
        }

        if (!isset($start_day) && !isset($end_day) && !isset($type) && !isset($age) && !isset($site)) {
            $query->whereRaw('1 = 0');
        }


        $results = $query->get();
        $avg = $results->avg('result');
        $min = $results->min('result');
        $max = $results->max('result');
        $searches = $query->paginate(10);
        $rq->session()->put('searches', $rq->query());
        $session = $rq->session()->get('searches');
        


        return view('admin.result.index',compact('searches','rq','avg','min','max','session'));
    }
}
