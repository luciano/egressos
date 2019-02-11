@extends('admin.layouts.nav')

@section('content')
    <h1>Editar Oportunidade</h1>
    {!! Form::open(['route' => ['admin.opportunities.update', $opportunity->id]]) !!}
        <div class="form-group">
            {{Form::label('title', 'Título da Oportunidade')}}
            {{Form::text('title', $opportunity->title, ['class' => 'form-control', 'placeholder' => 'Título'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Descrição da Oportunidade')}}
            {{Form::textarea('body', $opportunity->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Descrição da Oportunidade'])}}
        </div>
        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}
        <a href="{{route('admin.opportunities.index')}}" class="button alert">Cancelar</a> 
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Salvar', ['class' => 'button success'])}}
    {!! Form::close() !!}
@endsection