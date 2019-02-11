@extends('admin.layouts.nav')

@section('content')
    <h3 class="text-center">Gerenciar Oportunidades</h3>

    <div align="center" class="padding-2">
        <a href="{{route('admin.opportunities.create')}}" class="button large rounded bordered shadow primary ">Criar Oportunidade</a>
    </div>
        
    @if (count($opportunities) > 0)
        @foreach ($opportunities as $opportunity)
        <div align="center">
            <div align="left" class="callout width-75">
                <h3><a href="{{route('admin.opportunities.show', $opportunity->id)}}">{{$opportunity->title}}</a></h3>
                <small>Escrito em {{$opportunity->created_at->format('d/m/Y')}} às {{$opportunity->created_at->format('H:i')}} por {{$opportunity->admin->name}}</small>
            </div>
        </div>
        @endforeach
        {{-- using pagination automatically --}}
        {{$opportunities->links()}} 
    @else
        <p align="center">Nenhuma oportunidade encontrada!</p>
    @endif 
   
@endsection