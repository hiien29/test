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

        $url = $request->session()->get('searchUrl');
        $resultUrl = $request->session()->get('resultUrl');
        $request->session()->pull('resultUrl');
        
        if(isset($url))
        {
            return redirect($url);
        }
        else
        {
            return redirect($resultUrl);
        }
    }

    public function delete($id)
    {
        $data = Testlist::find($id);
        $data->delete();
        return redirect()->back();
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

        //GETで受け取ったリクエストを一つずつ変数に格納
        $start_day = $rq->input('start_day');
        $end_day = $rq->input('end_day');
        $type = $rq->input('type');
        $age = $rq->input('age');
        $site = $rq->input('site');

        //変数に値が入っていればTestlistの取得条件を追加していく
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
        $nosearch = '';
        //GETが全てからであればNULLを返す
        if (!isset($start_day) && !isset($end_day) && !isset($type) && !isset($age) && !isset($site)) 
        {
            $nosearch = $query->whereRaw('1 = 0');
        }

        //ページネーションにする前に取得結果を変数に格納（平均値、最大値、最小値）
        $results = $query->get();
        $avg = $results->avg('result');
        $min = $results->min('result');
        $max = $results->max('result');

        $searches = $query->paginate(10);
        $rq->session()->put('searches', $rq->query());
        $session = $rq->session()->get('searches');
        $rq->session()->put('searchUrl', $rq->fullUrl());


        return view('admin.result.index',compact('searches','rq','avg','min','max','session','nosearch'));
    }
}
