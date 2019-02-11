@extends('admin.layouts.nav')

@section('content')
    <h3 class="text-center">Gerenciar Notícias</h3>

    <div align="center" class="padding-2">
        <a href="{{route('admin.news.create')}}" class="button large rounded bordered shadow primary ">Criar Notícia</a>
    </div>
    
    @if (count($news) > 0)
        @foreach ($news as $new)
            <div align="center">
                <div align="left" class="callout width-75">
                    <h3><a href="{{route('admin.news.show', $new->id)}}">{{$new->title}}</a></h3>
                    <small>Escrito em {{$new->created_at->format('d/m/Y')}} às {{$new->created_at->format('H:i')}} por {{$new->admin->name}}</small>
                </div>
            </div>
            
            {{-- 
            <div class="col-md-4 col-sm-4">
                <img style="width: 100%" src="/storage/cover_images/{{$new->cover_image}}" />
            </div> 
            --}}
        @endforeach
        {{-- using pagination automatically --}}
        {{$news->links()}} 
    @else
        <p>Nenhuma notícia encontrada!</p>
    @endif 
   
@endsection