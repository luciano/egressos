@extends('admin.layouts.nav')

@section('content')
    <h3 class="text-center">Criar nova Oportunidade</h3><br>

    {!! Form::open(['route' => 'admin.opportunities.store']) !!}
        {{Form::label('title', 'Título da Oportunidade')}}
        {{Form::text('title', '', ['placeholder' => 'Título da Oportunidade'])}}
        {{Form::label('body', 'Descrição da Oportunidade')}}
        {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'placeholder' => 'Descrição da Oportunidade'])}}

        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}

        <br>
        <a href="{{route('admin.opportunities.index')}}" class="button alert">Cancelar</a> 
        {{Form::submit('Salvar', ['class' => 'button success'])}}
    {!! Form::close() !!}
@endsection