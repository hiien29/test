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

class TestScheduleController extends Controller
{
    
    public function create(): View
    {
        return view('admin.test_register');
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
        $testlist = Testlist::create([
            'make_day' => $request->make_day,
            'test_day' => $request->test_day,
            'age' => $request->age,
            'type' => $request->type,
            'site' => $request->site,
            'author' => $request->author,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        
        return redirect(route('admin.schedule'));
    }

    public function edit($id)
    {
        $params = Testlist::find($id);
        return view('admin.schedule_edit', compact('params'));
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

        $data->update($params);
        return redirect()->route('admin.schedule');
    }

    public function delete($id)
    {
        $data = Testlist::find($id);
        $data->delete();
        return redirect()->route('admin.schedule');
    }

    public function detail($id)
    {
        $details = Testlist::find($id);
        return view('admin.schedule_detail',compact('details'));
    }
}
