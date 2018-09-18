@extends('admin.layouts.nav')

@section('content')
    <h1>Criar nova Notícia</h1>
    {!! Form::open(['route' => 'admin.news.store']) !!}
        <div class="form-group">
            {{Form::label('title', 'Título da Notícia')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Título'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Corpo da Notícia')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Corpo da Notícia'])}}
        </div>
        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}
        <a href="{{route('admin.news.index')}}" class="btn btn-danger">Cancelar</a> 
        {{Form::submit('Salvar', ['class' => 'btn btn-success'])}}
    {!! Form::close() !!}
@endsection