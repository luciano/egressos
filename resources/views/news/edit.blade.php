@extends('admin.layouts.nav')

@section('content')
    <h1>Editar Notícia</h1>
    {!! Form::open(['route' => ['admin.news.update', $new->id]]) !!}
        <div class="form-group">
            {{Form::label('title', 'Título da Notícia')}}
            {{Form::text('title', $new->title, ['class' => 'form-control', 'placeholder' => 'Título'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Corpo da Notícia')}}
            {{Form::textarea('body', $new->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Corpo da Notícia'])}}
        </div>
        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}
        <a href="{{route('admin.news.index')}}" class="button alert">Cancelar</a> 
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Salvar', ['class' => 'button success'])}}
    {!! Form::close() !!}
@endsection