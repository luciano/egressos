@extends('admin.layouts.nav')

@section('content')
    <h1>Editar Evento</h1>
    {!! Form::open(['route' => ['admin.events.update', $event->id]]) !!}
        <div class="form-group">
            {{Form::label('title', 'Título do Evento')}}
            {{Form::text('title', $event->title, ['class' => 'form-control', 'placeholder' => 'Título'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Descrição do Evento')}}
            {{Form::textarea('body', $event->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Descrição do Evento'])}}
        </div>
        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}
        <a href="{{route('admin.events.index')}}" class="button alert">Cancelar</a> 
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Salvar', ['class' => 'button success'])}}
    {!! Form::close() !!}
@endsection