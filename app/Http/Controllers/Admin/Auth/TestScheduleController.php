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
use App\Rules\TypeRule;
use App\Models\Comment;

class TestScheduleController extends Controller
{
    
    public function create(): View
    {
        return view('admin.schedule.register');
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

        
        return redirect(route('admin.testregister'))->with('message', '登録が完了しました。');
    }


    public function edit(Request $rq,$id)
    {
        $params = Testlist::find($id);
        $url = $rq->headers->get('referer');
        
        return view('admin.schedule.edit', compact('params','url'));
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
        return redirect()->back();
    }

    public function detail($id)
    {
        $details = Testlist::find($id);
        $comments = Comment::where('testlist_id', $details->id)->orderBy('created_at','DESC')->get();
        return view('admin.schedule.detail',compact('details','comments'));
    }
}
