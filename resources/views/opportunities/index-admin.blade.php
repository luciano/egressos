@extends('admin.layouts.nav')

@section('content')
    <h1>Oportunidades para Admin</h1>
    <h5>{{Carbon\Carbon::now()->format('d/m/Y H:i:s')}}</h5>

    <p></p><a href="{{route('admin.opportunities.create')}}" class="btn btn-primary">Criar Oportunidade</a> </p>
    
    @if (count($opportunities) > 0)
        @foreach ($opportunities as $opportunity)
            <div class="well">
                <div class="row">
                    {{-- <div class="col-md-4 col-sm-4">
                        <img style="width: 100%" src="/storage/cover_images/{{$opportunity->cover_image}}" />
                    </div> --}}
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="{{route('admin.opportunities.show', $opportunity->id)}}">{{$opportunity->title}}</a></h3>
                        <small>Escrito em {{$opportunity->created_at->format('d/m/Y')}} às {{$opportunity->created_at->format('H:i')}} por {{$opportunity->admin->name}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- using pagination automatically --}}
        {{$opportunities->links()}} 
    @else
        <p>Nenhuma oportunidade encontrada!</p>
    @endif 
   
@endsection