<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * プロフィールに遷移
     */
    public function index(Request $request)
    {

        $user_id = Auth::id();

        $auth = Auth::user();

        $user = new User();
        $gender = $user->getUserGender();

        $posts = Post::with(['comments', 'category', 'user'])->orderBy('created_at', 'desc')->where('user_id', $user_id)->paginate(5);

        return view('user.profile', compact('auth', 'posts', 'user_id', 'gender'));
    }

    public function edit($id)
    {
        $auth = Auth::user();

        return view('user.edit', compact('auth'));
    }

    /**
     * ゲストユーザーの編集を禁止する為
     * $request->validated()でバリデーションがかかっている値のみ更新する
     */

    public function update(UserRequest $request)
    {
        $user = User::findOrFail($request->id);

        $user->fill($request->validated())->save();

        return redirect('user/index');
    }
}
