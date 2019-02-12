@extends('admin.layouts.nav')

@section('content')
    <h3 class="text-center">Criar nova Notícia</h3><br>

    {!! Form::open(['route' => 'admin.news.store']) !!}
        {{Form::label('title', 'Título da Notícia')}}
        {{Form::text('title', '', ['placeholder' => 'Título da Notícia'])}}
        {{Form::label('body', 'Corpo da Notícia')}}
        {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'placeholder' => 'Corpo da Notícia'])}}

        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}

        <br>
        <a href="{{route('admin.news.index')}}" class="button alert">Cancelar</a> 
        {{Form::submit('Salvar', ['class' => 'button success'])}}
    {!! Form::close() !!}
@endsection