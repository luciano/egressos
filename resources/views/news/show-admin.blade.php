@extends('admin.layouts.nav')

@section('content')
    <a href="{{route('admin.news.index')}}" class="btn btn-default">Voltar</a>
    <h1>{{$new->title}}</h1>        
    {{-- <img style="width: 100%" src="/storage/cover_images/{{$new->cover_image}}" /> --}}
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
    
    @auth
        {{-- Auth::id() == Auth::user()->id --}}
        @if(Auth::id() == $new->admin_id)
            <a href="{{route('admin.news.edit', $new->id)}}" class="btn btn-default">Edit</a>
            {!! Form::open(['action' => ['NewsController@destroy', $new->id], 'method' => 'POST']) !!} 
            {{-- , 'class' => 'pull-right' --}}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger', 'id' => 'btn-delete'])}}
            {!! Form::close() !!}
        @endif
        <br><br>
    @endauth
@endsection