@extends('admin.layouts.nav')

@section('content')
    <h1>Criar nova Oportunidade</h1>
    {!! Form::open(['route' => 'admin.opportunities.store']) !!}
        <div class="form-group">
            {{Form::label('title', 'Título da Oportunidade')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Título'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Descrição da Oportunidade')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Descrição da Oportunidade'])}}
        </div>
        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}
        <a href="{{route('admin.opportunities.index')}}" class="button alert">Cancelar</a> 
        {{Form::submit('Salvar', ['class' => 'button success'])}}
    {!! Form::close() !!}
@endsection