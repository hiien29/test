<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TestController extends Controller
{
    //
    public function create(): View
    {
        return view('admin.test_schedule');
    }
    public function test(): View
    {
        return view('admin.test');
    }
    public function result(): View
    {
        return view('admin.test_result');
    }
}
