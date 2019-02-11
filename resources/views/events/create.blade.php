@extends('admin.layouts.nav')

@section('content')
    <h1>Criar novo Evento</h1>
    {!! Form::open(['route' => 'admin.events.store']) !!}
        <div class="form-group">
            {{Form::label('title', 'Título do Evento')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Título'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Descrição do Evento')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Descrição do Evento'])}}
        </div>
        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}
        <a href="{{route('admin.events.index')}}" class="button alert">Cancelar</a> 
        {{Form::submit('Salvar', ['class' => 'button success'])}}
    {!! Form::close() !!}
@endsection