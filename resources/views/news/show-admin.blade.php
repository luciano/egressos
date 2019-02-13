@extends('admin.layouts.nav')

@section('content')
    <a href="{{route('admin.news.index')}}" class="button">Voltar</a>

    <h3 class="text-center">{{$new->title}}</h3>        
    
    {{-- <img style="width: 100%" src="/storage/cover_images/{{$new->cover_image}}" /> --}}
    <br><br>
    <div class="long-text-justify">
        {{-- to render HTML use double ! --}}
        {!!$new->body!!}
    </div>
    <hr>
    @if ($new->created_at != $new->updated_at)
        <small>Atualizado em {{$new->updated_at->format('d/m/Y')}} às {{$new->updated_at->format('H:i')}}</small><br>
    @endif
    <small>Escrito em {{$new->created_at->format('d/m/Y')}} às {{$new->created_at->format('H:i')}} por {{$new->admin->name}}</small>
    <br><br>
    @auth
        <div class="button-group">
        @if(Auth::id() == $new->admin_id)
            <a href="{{route('admin.news.edit', $new->id)}}" class="button">Editar</a>
            {!! Form::open(['route' => ['admin.news.destroy', $new->id]]) !!} 
            {{-- , 'class' => 'pull-right' --}}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'button alert', 'id' => 'btn-delete'])}}
            {!! Form::close() !!}
        @endif
        </div>
        <br><br>
    @endauth
@endsection