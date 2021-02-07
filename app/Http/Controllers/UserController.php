<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
        /**
     * プロフィールに遷移
     */
    public function index()
    {
        $auth = Auth::user();
        return view('user.profile',compact('auth'));
    }

    public function edit($id)
    {
        $auth = Auth::user();
        return view('user.edit',compact('auth'));
    }

    public function update(UserRequest $request)
    {
        // $validated = $request->validated();
        // User::create($validated);

        $user = User::findOrFail($request->id);

        $user->fill($request->all())->save();

        return redirect('user/index');

    }
}
