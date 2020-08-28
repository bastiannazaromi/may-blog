<?php

namespace App\Http\Controllers;

use App\Posts;
use App\category;
use App\Tags;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Posts::paginate(10);
        return view ('admin.post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category =  category::all();
        $tags = Tags::all();
        return view('admin.post.create', compact('category', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|min:3',
            'content' =>  'required|min:10',
            'kategori' => 'required',
            'tags' => 'required'
        ]);

        if($request->gambar)
        {
            $gambar = $request->file('gambar');
            $new_gambar = time().$gambar->getClientOriginalName();

            $post = Posts::create([
                'judul' => $request->judul,
                'category_id' => $request->kategori,
                'content' => $request->content,
                'gambar'=> 'public/uploads/posts/'. $new_gambar,
                'slug' => Str::slug($request->judul),
                'users_id' => Auth::id()
            ]);

            $gambar->move('public/uploads/posts/' , $new_gambar);
        }
        else
        {
            $post = Posts::create([
                'judul' => $request->judul,
                'category_id' => $request->kategori,
                'content' => $request->content,
                'slug' => Str::slug($request->judul),
                'users_id' => Auth::id()
            ]);
        }

        $post->tags()->attach($request->tags);

        return redirect()->route('post.index')->with('sukses','Posts berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Posts::findorfail($id);
        $tags = Tags::all();
        $category = category::all();
        return view('admin.post.edit', compact('post', 'tags', 'category'));
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
        $this->validate($request, [
            'judul' => 'required|min:3',
            'content' =>  'required|min:10',
            'kategori' => 'required',
        ]);

        $post = Posts::findorfail($id);

        if($request->gambar) {
            $gambar = $request->gambar;
            $new_gambar = time().$gambar->getClientOriginalName();
            $gambar->move('public/uploads/posts/', $new_gambar);

            $post_data = [
                'judul' => $request->judul,
                'category_id' => $request->kategori,
                'content' => $request->content,
                'gambar'=> 'public/uploads/posts/'. $new_gambar,
                'slug' => Str::slug($request->judul)
            ];
        }
        else {
            $post_data = [
                'judul' => $request->judul,
                'category_id' => $request->kategori,
                'content' => $request->content,
                'slug' => Str::slug($request->judul)
            ];
        }

        $post->tags()->sync($request->tags);
        $post->update($post_data);

        return redirect()->route('post.index')->with('sukses','Posts berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Posts::findorfail($id);
        $post->delete();

        return redirect()->route('post.index')->with('sukses','Posts berhasil dihapus');
    }

    public function trash_post()
    {
        $post = Posts::onlyTrashed()->paginate(10);
        return view('admin.post.trash',compact('post'));
    }

    public function restore($id)
    {
        $post = Posts::withTrashed()->find($id)->restore();

        return redirect()->route('post.trash')->with('sukses','Posts berhasil direstore');
    }

    public function kill($id)
    {
        $post = Posts::withTrashed()->find($id)->forceDelete();

        return redirect()->route('post.trash')->with('sukses','Posts berhasil dihapus permanen');
    }
}
