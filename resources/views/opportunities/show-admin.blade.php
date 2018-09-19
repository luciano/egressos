@extends('admin.layouts.nav')

@section('content')
    <a href="{{route('admin.opportunities.index')}}" class="btn btn-default">Voltar</a>
    <h1>{{$opportunity->title}}</h1>
    {{-- <img style="width: 100%" src="/storage/cover_images/{{$opportunity->cover_image}}" /> --}}
    <br><br>
    <div>
        {{-- to render HTML use double ! --}}
        {!!$opportunity->body!!}
    </div>
    <hr>
    <small>Número de Visitas: {{$opportunity->visited}}</small><br>
    @if ($opportunity->created_at != $opportunity->updated_at)
        <small>Atualizado em {{$opportunity->updated_at->format('d/m/Y')}} às {{$opportunity->updated_at->format('H:i')}}</small><br>
    @endif
    <small>Escrito em {{$opportunity->created_at->format('d/m/Y')}} às {{$opportunity->created_at->format('H:i')}} por {{$opportunity->admin->name}}</small>
    
    @auth
        {{-- Auth::id() == Auth::user()->id --}}
        @if(Auth::id() == $opportunity->admin_id)
            <a href="{{route('admin.opportunities.edit', $opportunity->id)}}" class="btn btn-default">Editar</a>
            {!! Form::open(['route' => ['admin.opportunities.destroy', $opportunity->id]]) !!} 
            {{-- , 'class' => 'pull-right' --}}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger', 'id' => 'btn-delete'])}}
            {!! Form::close() !!}
        @endif
        <br><br>
    @endauth
@endsection