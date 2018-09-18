@extends('admin.layouts.nav')

@section('content')
    <h1>Notícias para Admin</h1>
    <h5>{{Carbon\Carbon::now()->format('d/m/Y H:i:s')}}</h5>

    <p></p><a href="{{route('admin.news.create')}}" class="btn btn-primary">Criar Notícia</a> </p>
    
    @if (count($news) > 0)
        @foreach ($news as $new)
            <div class="well">
                <div class="row">
                    {{-- <div class="col-md-4 col-sm-4">
                        <img style="width: 100%" src="/storage/cover_images/{{$new->cover_image}}" />
                    </div> --}}
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="{{route('admin.news.show', $new->id)}}">{{$new->title}}</a></h3>
                        <small>Escrito em {{$new->created_at->format('d/m/Y')}} às {{$new->created_at->format('H:i')}} por {{$new->admin->name}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- using pagination automatically --}}
        {{$news->links()}} 
    @else
        <p>Nenhuma notícia encontrada!</p>
    @endif 
   
@endsection