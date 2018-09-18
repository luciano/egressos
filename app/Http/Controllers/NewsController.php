<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin')->except(['index', 'show']);
        $this->middleware('auth')->only(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(10);
        return view('news.index-admin')->with('news', $news);
    }

    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(10);
        return view('news.index')->with('news', $news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
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
            'title' => 'required',
            'body' => 'required',
            //'cover_image' => 'image|nullable|max:1999'
        ]);

        // use tinker to save data
        $news = new News();
        $news->title = $request->input('title');
        $news->body = $request->input('body');
        $news->admin_id = auth()->user()->id;
        //$post->cover_image = $fileNameToStore;
        $news->save();

        return redirect(route('admin.news.index'))->with('success', 'Notícia criada com Sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!is_numeric($id))
            return redirect(route('user.news.index'));
        $new = News::find($id);
        return view('news.show')->with('new', $new);
    }

    public function showAdmin($id)
    {
        if (!is_numeric($id))
            return redirect(route('admin.news.index'));
        $new = News::find($id);
        return view('news.show-admin')->with('new', $new);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!is_numeric($id))
            return redirect(route('admin.news.index'));
        $new = News::find($id);
        return view('news.edit')->with('new', $new);
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
            'title' => 'required',
            'body' => 'required',
            //'cover_image' => 'image|nullable|max:1999'
        ]);

        // use tinker to save data
        $news = News::find($id);
        $news->title = $request->input('title');
        $news->body = $request->input('body');
        //$post->cover_image = $fileNameToStore;
        $news->save();

        return redirect(route('admin.news.index'))->with('success', 'Notícia editada com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!is_numeric($id))
            return redirect(route('admin.news.index'));

        $new = News::find($id);
        
        if (auth()->user()->id !== $new->admin_id) {
            return redirect(route('admin.news.index'))->with('error', 'Página não autorizada!');
        }

        // if ($post->cover_image != 'noimage.jpg') {
        //     // delete
        //     Storage::delete('public/cover_images/'.$post->cover_image);
        // }

        $new->delete();
        return redirect(route('admin.news.index'))->with('success', 'Notícia removida com Sucesso');
    }
}
