@extends('admin.layouts.nav')

@section('content')
    <h3 class="text-center">Editar Evento</h3><br>

    {!! Form::open(['route' => ['admin.events.update', $event->id]]) !!}
        {{Form::label('title', 'Título do Evento')}}
        {{Form::text('title', $event->title, ['class' => 'form-control', 'placeholder' => 'Título do Evento'])}}
        {{Form::label('body', 'Descrição do Evento')}}
        {{Form::textarea('body', $event->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Descrição do Evento'])}}
        
        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}

        <br>
        <a href="{{route('admin.events.index')}}" class="button alert">Cancelar</a> 
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Salvar', ['class' => 'button success'])}}
    {!! Form::close() !!}
@endsection