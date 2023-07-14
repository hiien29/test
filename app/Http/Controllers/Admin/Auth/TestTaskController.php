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
use App\Models\Comment;
use App\Models\Result;


class TestTaskController extends Controller
{
    
    public function show(Request $rq,$id)
    {
        $data = Testlist::find($id);
        $comments = Comment::where('testlist_id', $data->id)->orderBy('created_at','DESC')->get();
        $url = $rq->headers->get('referer');
        return view('admin.task.register',compact('data','comments','url'));
    }

    public function register(Request $request,$id)
    {
        $data = Testlist::find($id);
        $params = $request->validate([
            'result' => ['required','numeric'] ,
            'tester' => 'required'
        ]);
        $params['tester'] = $params['tester'].PHP_EOL.'（登録日時：'.date("Y/m/d H:i").'）';

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
        $params = Testlist::find($id);
        $url = $rq->headers->get('referer');
        return view('admin.task.edit', compact('params','url'));
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

        $url = $request->url;
        $data->update($params);
        return redirect($url);
    }

    public function delete($id)
    {
        $data = Testlist::find($id);
        $data->delete();
        return redirect()->route('admin.test');
        
    }

    public function detail($id)
    {
        $details = Testlist::find($id);
        $comments = Comment::where('testlist_id', $details->id)->orderBy('created_at','DESC')->get();
        return view('admin.task.detail',compact('details','comments'));
    }
}
