<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('profile.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        if ($user->email != $request->email) {
            $user->email_verified_at = null;
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        if ($user->save()) {

            Cache::put('user_' . $user->id, $user, 60);
            Cache::forget('users');

            return redirect()->route('admin.profile')->with('success', __('admin.message.success.transaction'));
        } else {
            return redirect()->route('admin.profile')->with('error', __('admin.message.error.transaction'));
        }
    }
}
