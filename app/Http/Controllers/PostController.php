<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\User;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\m_responsekeys(conn, identifier)
     */

    public function __construct() {
        $this->middleware('auth');
    }
    public function index()
    {   $this->authorize('viewAny',Post::class);
        $data['listPost'] = Post::all();
        return view('postList',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        if($user->can('create',Post::class)){
            $id= Auth::id();
            Post::create([
                'title' => $request['title'],
                'content' => $request['content'],
                'user_id' => $id,
            ]);
            return redirect('posts/');
        }
        else {
            return redirect('posts/')->with(['error'=>'You have not permission']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['post'] = Post::find($id);
        return view('detailPost',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['post'] = Post::find($id);
        return view('editPost',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post=Post::find($id);
        $this->authorize('update',$post);
        $data = $request->except('_token','_method');
        Post::where('id',$id)->update($data);
        return redirect('posts/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect('posts/');
    }
}
