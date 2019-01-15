<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;

class EventsController extends Controller
{
    /**
     * Create a event controller instance.
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
        $events = Events::orderBy('created_at', 'desc')->paginate(10);
        return view('events.index-admin')->with('events', $events);
    }

    public function index() //Request $request)
    {
        $events = Events::orderBy('created_at', 'desc')->paginate(10);
        // avoid reload entire page
        // if($request->ajax()) {
        //     return view('events.index')->with('events', $events)->renderSections()['content'];
        // }
        return view('events.index')->with('events', $events);
    }

    /**
     * Show the form for creating a event resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a evently created resource in storage.
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
        $event = new Events();
        $event->title = $request->input('title');
        $event->body = $request->input('body');
        $event->admin_id = auth()->user()->id;
        //$post->cover_image = $fileNameToStore;
        $event->save();

        return redirect(route('admin.events.index'))->with('success', 'Evento criado com Sucesso!');
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
            return redirect(route('user.events.index'));
        $event = Events::find($id);
        $event->visited = $event->visited + 1;
        $event->timestamps = false;
        $event->save();
        $event->timestamps = true;
        return view('events.show')->with('event', $event);
    }

    public function showAdmin($id)
    {
        if (!is_numeric($id))
            return redirect(route('admin.events.index'));
        $event = Events::find($id);
        $event->visited = $event->visited + 1;
        $event->timestamps = false;
        $event->save();
        $event->timestamps = true;
        return view('events.show-admin')->with('event', $event);
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
            return redirect(route('admin.events.index'));
        $event = Events::find($id);
        return view('events.edit')->with('event', $event);
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
        $event = Events::find($id);
        $event->title = $request->input('title');
        $event->body = $request->input('body');
        //$post->cover_image = $fileNameToStore;
        $event->save();

        return redirect(route('admin.events.index'))->with('success', 'Evento editado com Sucesso!');
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
            return redirect(route('admin.events.index'));

        $event = Events::find($id);
        
        if (auth()->user()->id !== $event->admin_id) {
            return redirect(route('admin.events.index'))->with('error', 'Página não autorizada!');
        }

        // if ($post->cover_image != 'noimage.jpg') {
        //     // delete
        //     Storage::delete('public/cover_images/'.$post->cover_image);
        // }

        $event->delete();
        return redirect(route('admin.events.index'))->with('success', 'Evento removido com Sucesso');
    }
}
