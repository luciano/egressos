@extends('layouts.app')

@section('content')
    <a href="{{route('user.news.index')}}" class="btn btn-default">Voltar</a>
    <h1>{{$new->title}}</h1>        
    {{-- <img style="width: 100%" src="/storage/cover_images/{{$post->cover_image}}" /> --}}
    <br><br>
    <div>
        {{-- to render HTML use double ! --}}
        {!!$new->body!!}
    </div>
    <hr>
    @if ($new->created_at != $new->updated_at)
        <small>Atualizado em {{$new->updated_at->format('d/m/Y')}} às {{$new->updated_at->format('H:i')}}</small><br>
    @endif
    <small>Escrito em {{$new->created_at->format('d/m/Y')}} às {{$new->created_at->format('H:i')}} por {{$new->admin->name}}</small>
@endsection