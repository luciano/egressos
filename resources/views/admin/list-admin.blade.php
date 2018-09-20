@extends('admin.layouts.nav')

@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3>Lista de Administradores <a href="{{route('admin.users.index')}}" class="btn btn-default pull-right">Voltar</a></h3>
            </div>

            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Título</th>
                            <th>Criado em</th>
                            <th>Ultima modificação em</th>
                            <th>Editar</th>
                            <th>Deletar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td>{{$admin->name}}</td>
                                <td>{{$admin->email}}</td>
                                <td>{{$admin->job_title}}</td>
                                <td>{{$admin->created_at->format('d/m/Y \á\s H:i')}}</td>
                                <td>{{$admin->updated_at->format('d/m/Y \á\s H:i')}}</td>
                                <td><a href="{{route('admin.users.index')}}"><span class="glyphicon glyphicon-edit"></span></a></td>
                                @if (Auth::id() == $admin->id)
                                    <td></a></td>    
                                @else
                                    <td><a href="{{route('admin.users.index')}}"><span class="glyphicon glyphicon-trash"></span></a></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$admins->links()}} 
        </div>
    </div>    
@endsection