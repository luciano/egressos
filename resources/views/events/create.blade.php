@extends('admin.layouts.nav')

@section('content')
    <h3 class="text-center">Criar novo Evento</h3><br>

    {!! Form::open(['route' => 'admin.events.store']) !!}
        {{Form::label('title', 'Título do Evento')}}
        {{Form::text('title', '', ['placeholder' => 'Título do Evento'])}}
        {{Form::label('body', 'Descrição do Evento')}}
        {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'placeholder' => 'Descrição do Evento'])}}

        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}

        <br>
        <a href="{{route('admin.events.index')}}" class="button alert">Cancelar</a> 
        {{Form::submit('Salvar', ['class' => 'button success'])}}
    {!! Form::close() !!}
@endsection