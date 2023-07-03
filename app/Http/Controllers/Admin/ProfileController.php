<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminProfileUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Department;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(AdminProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        

        if ($request->user()->isDirty()) {
            $request->user()->save();
        }

        

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show() {
        $departments = Department::all();
        $admins = Admin::all();
        return view ('admin.profile.register',compact('departments','admins'));
    }

    public function register(Request $request) {
        $request -> validate([
            'depart_number' => 'required',
            'depart_name' => 'required'
        ]);
        $departments = Department::create([
            'number' => $request->depart_number,
            'name' => $request->depart_name,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return Redirect::route('admin.profile.register')->with('message', '部署を追加しました。');
    }

    public function delete($id) {
        $data = Department::find($id);
        $data->delete();
        return Redirect::route('admin.profile.register')->with('message_', '部署を削除しました。');
    }

    public function adminRegister(Request $request) {
        $request -> validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $admins = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return Redirect::route('admin.profile.register')->with('message___', '管理者を追加しました。');
    }

    public function adminDelete($id) {
        $data = Admin::find($id);
        $data->delete();
        return Redirect::route('admin.profile.register')->with('message___', '管理者を削除しました。');
    }
}
