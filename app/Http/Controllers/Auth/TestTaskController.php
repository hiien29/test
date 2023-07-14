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



class TestTaskController extends Controller
{
    
    public function show(Request $rq,$id)
    {
        $data = Testlist::find($id);
        $comments = Comment::where('testlist_id', $data->id)->orderBy('created_at','DESC')->get();
        $url = $rq->headers->get('referer');
        return view('task.register',compact('data','comments','url'));
    }

    public function register(Request $request,$id)
    {
        $data = Testlist::find($id);
        $params = $request->validate([
            'result' => ['required','numeric'] ,
            'tester' => 'required'
        ]);
        $params['tester'] = $params['tester'].PHP_EOL.'（登録日時：'.date("Y/m/d H:i").'）';

        $log = [
            'user_id' => Auth::id(),
            'action' => '登録',
            'description' => '試験ID:' . $id.'の試験結果を登録しました。',
            'created_at' => now(),
            'updated_at' => now()
        ];
        Log::create($log);

        if(isset($request->comment))
        {
        $comment = [
            'testlist_id' => $id,
            'enterer' => $request->tester,
            'comment' => $request->comment,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        Comment::create($comment);
        }

        $url = $request->url;
        $data->update($params);
        return redirect($url);
    }

    public function edit(Request $rq,$id)
    {
        $url = $rq->headers->get('referer');
        $params = Testlist::find($id);
        return view('task.edit', compact('params','url'));
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
        ]);

        $data->make_day = $params['make_day'];
        $data->test_day = $params['test_day'];
        $data->age = $params['age'];
        $data->type = $params['type'];
        $data->site = $params['site'];

        $data->save();

        $request->validate([
            'comment' => 'required',
            'editor' => 'required',
        ]);
        $comment =[
            'testlist_id' => $id,
            'comment' => $request->comment,
            'enterer' => $request->editor,
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
                } else {
                    $columnName = $column;
                }
                $modifiedColumns[] = $columnName;
            }
            
            $logDescription .= implode('、', $modifiedColumns) . 'を変更しました。';
            $log = [
                'user_id' => Auth::id(),
                'action' => '編集',
                'description' => $logDescription,
                'created_at' => now(),
                'updated_at' => now()
            ];
            Log::create($log);
        }

        $url = $request->url;
        $data->update($params);
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
        return redirect()->route('test');
        
    }

    public function detail($id)
    {
        $details = Testlist::find($id);
        $comments = Comment::where('testlist_id', $details->id)->orderBy('created_at','DESC')->get();
        return view('task.detail',compact('details','comments'));
    }
}
