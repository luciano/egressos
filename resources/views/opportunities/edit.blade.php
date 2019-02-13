@extends('admin.layouts.nav')

@section('content')
    <h3 class="text-center">Editar Oportunidade</h3><br>

    {!! Form::open(['route' => ['admin.opportunities.update', $opportunity->id]]) !!}
        {{Form::label('title', 'Título da Oportunidade')}}
        {{Form::text('title', $opportunity->title, ['class' => 'form-control', 'placeholder' => 'Título'])}}
        {{Form::label('body', 'Descrição da Oportunidade')}}
        {{Form::textarea('body', $opportunity->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Descrição da Oportunidade'])}}

        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}

        <br>
        <a href="{{route('admin.opportunities.index')}}" class="button alert">Cancelar</a> 
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Salvar', ['class' => 'button success'])}}
    {!! Form::close() !!}
@endsection