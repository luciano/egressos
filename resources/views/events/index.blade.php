@extends('layouts.app')

@section('content')
    <h1>Eventos para User</h1>   
    @if (count($events) > 0)
        @foreach ($events as $event)
            <div class="well">
                <div class="row">
                    {{-- <div class="col-md-4 col-sm-4">
                        <img style="width: 100%" src="/storage/cover_images/{{$event->cover_image}}" />
                    </div> --}}
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="{{route('user.events.show', $event->id)}}">{{$event->title}}</a></h3>
                        <small>Escrito em {{$event->created_at->format('d/m/Y')}} às {{$event->created_at->format('H:i')}} por {{$event->admin->name}}</small>
                    </div>
                </div>
            </div>            
        @endforeach
        {{-- using pagination automatically --}}
        {{$events->links()}} 
    @else
        <p>Nenhuma evento encontrada!</p>
    @endif 
@endsection