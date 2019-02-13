@extends('admin.layouts.nav')

@section('content')
    <h3 class="text-center">Editar Notícia</h3><br>

    {!! Form::open(['route' => ['admin.news.update', $new->id]]) !!}
        {{Form::label('title', 'Título da Notícia')}}
        {{Form::text('title', $new->title, ['class' => 'form-control', 'placeholder' => 'Título'])}}
        {{Form::label('body', 'Corpo da Notícia')}}
        {{Form::textarea('body', $new->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Corpo da Notícia'])}}

        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}

        <br>
        <a href="{{route('admin.news.index')}}" class="button alert">Cancelar</a> 
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Salvar', ['class' => 'button success'])}}
    {!! Form::close() !!}
@endsection