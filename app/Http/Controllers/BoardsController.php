<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests\Storeposts;
use Illuminate\Support\Facades\Auth;

class BoardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        // $posts = DB::table('posts')->select('title','body','created_at','comments')->get();

        $category = new Category();
        $categories = $category->getLists();

        $searchword = $request->searchword;

        $category_id = $request->category_id;

        $posts = Post::with(['comments','category','user:id,name'])->orderBy('created_at', 'desc')->categoryId($category_id)->searchWords($searchword)->paginate(10);
        // dd($posts);


        return view('posts.index',compact('posts','categories','category_id','searchword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $category = new Category();
       $categories = $category->getLists()->prepend('選択','');

       $post = new Post();
        $posts = $post->user_id = $request->user()->id;

        return view('posts.create',compact('categories','posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeposts $request)
    {

        $validated = $request->validated();
        Post::create($validated);

        return redirect('board/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = new Category();
        $categories = $category->getLists()->prepend('選択','');

        $post = Post::findOrFail($id);

        return view('posts.edit' ,compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Storeposts $request, $id)
    {

        $post = Post::findOrFail($request->id);

        $post->fill($request->all())->save();

        return redirect('board/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        DB::transaction(function () use ($post){
            $post->comments()->delete();
            $post->delete();
        });
        return redirect('board/index');

    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('user.login');
    }
    /**
     * プロフィールに遷移
     */
    public function getProfile()
    {
        return view('user.profile');
    }
}
