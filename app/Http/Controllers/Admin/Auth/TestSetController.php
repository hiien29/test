<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use App\Models\Log;
use App\Models\User;
use App\Models\Admin;
use App\Models\Department;


class TestSetController extends Controller
{
    
    public function log() {
        $logs = Log::Leftjoin('users','logs.user_id', '=', 'users.id')
        ->select('logs.*', 'users.name')
        ->orderBy('logs.created_at', 'DESC')
        ->paginate(10);

        return view ('admin.set.log', compact('logs'));
    }

    public function user() {
        $users = User::join('departments','users.department_number','=','departments.number')
        ->select('users.*','departments.name AS department_name')
        ->paginate(10);

        return view('admin.set.user',compact('users'));
    }

    public function admin() {
        $admins = Admin::paginate(5);

        return view('admin.set.admin',compact('admins'));
    }

    public function department() {
        $departments = Department::paginate(10);

        return view('admin.set.department',compact('departments'));
    }

    public function user_delete($id) {
        $data = User::find($id);
        $data->delete();
        return Redirect::back()->with('message','ユーザーを削除しました。');
    }
}
