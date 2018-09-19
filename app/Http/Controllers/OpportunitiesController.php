<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opportunities;

class OpportunitiesController extends Controller
{
    /**
     * Create a opportunity controller instance.
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
        $opportunities = Opportunities::orderBy('created_at', 'desc')->paginate(10);
        return view('opportunities.index-admin')->with('opportunities', $opportunities);
    }

    public function index()
    {
        $opportunities = Opportunities::orderBy('created_at', 'desc')->paginate(10);
        return view('opportunities.index')->with('opportunities', $opportunities);
    }

    /**
     * Show the form for creating a opportunity resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('opportunities.create');
    }

    /**
     * Store a opportunityly created resource in storage.
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
        $opportunity = new Opportunities();
        $opportunity->title = $request->input('title');
        $opportunity->body = $request->input('body');
        $opportunity->admin_id = auth()->user()->id;
        //$post->cover_image = $fileNameToStore;
        $opportunity->save();

        return redirect(route('admin.opportunities.index'))->with('success', 'Oportunidade criada com Sucesso!');
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
            return redirect(route('user.opportunities.index'));
        $opportunity = Opportunities::find($id);
        $opportunity->visited = $opportunity->visited + 1;
        $opportunity->timestamps = false;
        $opportunity->save();
        $opportunity->timestamps = true;
        return view('opportunities.show')->with('opportunity', $opportunity);
    }

    public function showAdmin($id)
    {
        if (!is_numeric($id))
            return redirect(route('admin.opportunities.index'));
        $opportunity = Opportunities::find($id);
        $opportunity->visited = $opportunity->visited + 1;
        $opportunity->timestamps = false;
        $opportunity->save();
        $opportunity->timestamps = true;
        return view('opportunities.show-admin')->with('opportunity', $opportunity);
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
            return redirect(route('admin.opportunities.index'));
        $opportunity = Opportunities::find($id);
        return view('opportunities.edit')->with('opportunity', $opportunity);
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
        $opportunity = Opportunities::find($id);
        $opportunity->title = $request->input('title');
        $opportunity->body = $request->input('body');
        //$post->cover_image = $fileNameToStore;
        $opportunity->save();

        return redirect(route('admin.opportunities.index'))->with('success', 'Oportunidade editada com Sucesso!');
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
            return redirect(route('admin.opportunities.index'));

        $opportunity = Opportunities::find($id);
        
        if (auth()->user()->id !== $opportunity->admin_id) {
            return redirect(route('admin.opportunities.index'))->with('error', 'Página não autorizada!');
        }

        // if ($post->cover_image != 'noimage.jpg') {
        //     // delete
        //     Storage::delete('public/cover_images/'.$post->cover_image);
        // }

        $opportunity->delete();
        return redirect(route('admin.opportunities.index'))->with('success', 'Oportunidade removida com Sucesso');
    }
}
