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
use App\Models\Comment;
use App\Models\Log;


class TestResultController extends Controller
{

    public function edit(Request $rq,$id)
    {
        $url = $rq->headers->get('referer');
        $params = Testlist::find($id);
        return view('result.edit', compact('params','url'));
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
            'result' => 'required',
        ]);


        $data->make_day = $params['make_day'];
        $data->test_day = $params['test_day'];
        $data->age = $params['age'];
        $data->type = $params['type'];
        $data->site = $params['site'];
        $data->result = $params['result'];
        $data->save();

        $request->validate([
            'comment' => 'required',
            'editor' => 'required',
        ]);
        $comment =[
            'testlist_id' => $id,
            'enterer' => $request->editor,
            'comment' => $request->comment,
        ];
        Comment::create($comment);

        //logsテーブル作成
        $changes = $data->getChanges();
        if (!empty($changes)) {
            
            unset($changes['updated_at']);
            $logDescription = '試験ID:' . $id . 'の';
            foreach ($changes as $column => $newValue) {
                if ($column === 'make_day') {
                    $columnName = '打設日';
                } elseif ($column === 'test_day') {
                    $columnName = '試験日';
                } elseif ($column === 'age') {
                    $columnName = '材齢';
                } elseif ($column === 'type') {
                    $columnName = '配合';
                } elseif ($column === 'site') {
                    $columnName = '現場名';
                } elseif ($column === 'result') {
                    $columnName = "試験結果";
                } else {
                    $columnName = $column;
                }
                $modifiedColumns[] = $columnName;
            }
            
            $logDescription .= implode('、', $modifiedColumns) . 'を変更しました。';

            $log = [
                'user_id' => Auth::id(),
                'action' => "編集",
                'description' => $logDescription,
                'created_at' => now(),
                'updated_at' => now()
            ];
            Log::create($log);
        }
        $data->update($params);
        $url = $request->url;

        return redirect($url);

    }

    public function delete($id)
    {
        $data = Testlist::find($id);
        $log = [
            'user_id' => Auth::id(),
            'action' => '削除',
            'description' => '試験ID:' . $id.'を削除しました。'.PHP_EOL.'（試験日：'.$data->test_day.'、材齢：'.$data->age.'日、配合：'.$data->type.'、現場：'.$data->site.'）',
            'created_at' => now(),
            'updated_at' => now()
        ];
        Log::create($log);
        $data->delete();
        return redirect()->back();
        
    }

    public function detail($id)
    {
        $details = Testlist::find($id);
        $comments = Comment::where('testlist_id', $details->id)->orderBy('created_at','DESC')->get();
        return view('result.detail',compact('details','comments'));
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


        return view('result.index',compact('searches','rq','avg','min','max','session','nosearch'));
    }
}
