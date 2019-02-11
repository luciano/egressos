@extends('admin.layouts.nav')

@section('content')
    <h3 class="text-center">Gerenciar Eventos</h3>

    <div align="center" class="padding-2">
        <a href="{{route('admin.events.create')}}" class="button large rounded bordered shadow primary ">Criar Evento</a>
    </div>
    
    @if (count($events) > 0)
        @foreach ($events as $event)
            <div align="center">
                <div align="left" class="callout width-75">
                <h3><a href="{{route('admin.events.show', $event->id)}}">{{$event->title}}</a></h3>
                        <small>Escrito em {{$event->created_at->format('d/m/Y')}} às {{$event->created_at->format('H:i')}} por {{$event->admin->name}}</small>
                </div>
            </div>
        @endforeach
        {{-- using pagination automatically --}}
        {{$events->links()}} 
    @else
        <p>Nenhuma evento encontrado!</p>
    @endif 
   
@endsection