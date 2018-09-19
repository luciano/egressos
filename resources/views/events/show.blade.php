@extends('layouts.app')

@section('content')
    <a href="{{route('user.events.index')}}" class="btn btn-default">Voltar</a>
    <h1>{{$event->title}}</h1>        
    {{-- <img style="width: 100%" src="/storage/cover_images/{{$post->cover_image}}" /> --}}
    <br><br>
    <div>
        {{-- to render HTML use double ! --}}
        {!!$event->body!!}
    </div>
    <hr>
    <small>Número de Visitas: {{$event->visited}}</small><br>
    @if ($event->created_at != $event->updated_at)
        <small>Atualizado em {{$event->updated_at->format('d/m/Y')}} às {{$event->updated_at->format('H:i')}}</small><br>
    @endif
    <small>Escrito em {{$event->created_at->format('d/m/Y')}} às {{$event->created_at->format('H:i')}} por {{$event->admin->name}}</small>
@endsection