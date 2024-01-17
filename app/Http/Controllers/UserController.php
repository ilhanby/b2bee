<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $users = Cache::remember('users', 60, function () {
            return User::all(['id', 'name', 'email', 'status', 'is_delete', 'updated_at']);
        });

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->status = $request->status == 'active' ? "1" : "0";

        if ($user->save()) {

            Cache::put('user_' . $user->id, $user, 60);
            Cache::forget('users');

            Log::channel('db')->info('User created', [
                'name' => $user->name,
                'email' => $user->email,
            ]);

            return redirect()->route('admin.users.index')->with('success', __('admin.message.success.transaction'));
        } else {
            return redirect()->route('admin.users.index')->with('error', __('admin.message.error.transaction'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function show(int $id): RedirectResponse
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $user = Cache::remember('user_' . $id, 60, function () use ($id) {
            return User::findOrFail($id, ['id', 'name', 'email', 'status', 'is_delete', 'updated_at']);
        });

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status == 'active' ? "1" : "0";

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($user->save()) {

            Cache::put('user_' . $user->id, $user, 60);
            Cache::forget('users');

            Log::channel('db')->info('User updated', [
                'name' => $user->name,
                'email' => $user->email,
            ]);

            return redirect()->route('admin.users.index')->with('success', __('admin.message.success.transaction'));
        } else {
            return redirect()->route('admin.users.index')->with('error', __('admin.message.error.transaction'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return array
     */
    public function destroy(int $id): array
    {
        $user = User::findOrFail($id);

        if ($user->is_delete == 1) {
            if (User::destroy($id)) {

                Cache::forget('user_' . $user->id);
                Cache::forget('users');

                Log::channel('db')->info('User deleted', [
                    'name' => $user->name,
                    'email' => $user->email,
                ]);

                return ['status' => 'success', 'title' => __('admin.message.success'), 'message' => __('admin.message.success.transaction')];
            } else {
                return ['status' => 'error', 'title' => __('admin.message.error'), 'message' => __('admin.message.error.transaction')];
            }
        } else {
            return ['status' => 'error', 'title' => __('admin.message.error'), 'message' => __('admin.message.error.transaction')];
        }
    }
}
