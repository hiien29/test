<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\Log;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

        $departments = Department::select('name')
        ->where('number','=',$request->user()->department_number)->get();
        $department = $departments->first()->name;
        $user = $request->user();
        
        return view('profile.edit', compact('user','department'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        

        if ($request->user()->isDirty()) {
            $request->user()->save();
        }

        

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    // : RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        $log = [
            'user_id' => NULL,
            'action' => '削除',
            'description' => $user->name.'さんがアカウントを削除しました。',
            'created_at' => now(),
            'updated_at' => now()
        ];
        Log::create($log);

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
