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
use App\Models\Log;
use App\Models\Comment;

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
            'updated_at' => now(),
        ];

        
        $createTestlist = Testlist::create($testlist);

        if(isset($request->comment))
        {
        $comment = [
            'testlist_id' => $createTestlist->id,
            'enterer' => $request->author,
            'comment' => $request->comment,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        Comment::create($comment);
        }

        $log = [
            'user_id' => Auth::id(),
            'action' => '作成',
            'description' => '試験ID:' . $createTestlist->id.'を作成しました。',
            'created_at' => now(),
            'updated_at' => now()
        ];
        Log::create($log);

        
        return redirect(route('testregister'))->with('message', '登録が完了しました。');
    }



    public function edit(Request $rq,$id)
    {
        $params = Testlist::find($id);
        $url = $rq->headers->get('referer');
        return view('schedule.edit', compact('params','url'));
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
        return view('schedule.detail',compact('details','comments'));
    }
}
