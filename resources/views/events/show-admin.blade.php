@extends('admin.layouts.nav')

@section('content')
    <a href="{{route('admin.events.index')}}" class="btn btn-default">Voltar</a>
    <h1>{{$event->title}}</h1>
    {{-- <img style="width: 100%" src="/storage/cover_images/{{$event->cover_image}}" /> --}}
    <br><br>
    <div>
        {{-- to render HTML use double ! --}}
        {!!$event->body!!}
    </div>
    <hr>
    <small>Número de Visitas: {{$event->visited}}</small><br>
    @if ($event->created_at != $event->updated_at)
        <small>Atualizado em {{$event->updated_at->format('d/m/Y \á\s H:i')}}</small><br>
    @endif
    <small>Escrito em {{$event->created_at->format('d/m/Y \á\s H:i')}} por {{$event->admin->name}}</small>
    
    @auth
        {{-- Auth::id() == Auth::user()->id --}}
        @if(Auth::id() == $event->admin_id)
            <a href="{{route('admin.events.edit', $event->id)}}" class="btn btn-default">Editar</a>
            {!! Form::open(['route' => ['admin.events.destroy', $event->id]]) !!} 
            {{-- , 'class' => 'pull-right' --}}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger', 'id' => 'btn-delete'])}}
            {!! Form::close() !!}
        @endif
        <br><br>
    @endauth
@endsection