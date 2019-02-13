@extends('admin.layouts.nav')

@section('content')
    <a href="{{route('admin.events.index')}}" class="button">Voltar</a>

    <h3 class="text-center">{{$event->title}}</h3>
    
    {{-- <img style="width: 100%" src="/storage/cover_images/{{$event->cover_image}}" /> --}}
    <br><br>
    <div class="long-text-justify">
        {{-- to render HTML use double ! --}}
        {!!$event->body!!}
    </div>
    <hr>
    <small>Número de Visitas: {{$event->visited}}</small><br>
    @if ($event->created_at != $event->updated_at)
        <small>Atualizado em {{$event->updated_at->format('d/m/Y \á\s H:i')}}</small><br>
    @endif
    <small>Escrito em {{$event->created_at->format('d/m/Y \á\s H:i')}} por {{$event->admin->name}}</small>
    <br><br>
    @auth
        <div class="button-group">
        @if(Auth::id() == $event->admin_id)
            <a href="{{route('admin.events.edit', $event->id)}}" class="button">Editar</a>
            {!! Form::open(['route' => ['admin.events.destroy', $event->id]]) !!} 
            {{-- , 'class' => 'pull-right' --}}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'button alert', 'id' => 'btn-delete'])}}
            {!! Form::close() !!}
        @endif
        </div>
        <br><br>
    @endauth
@endsection