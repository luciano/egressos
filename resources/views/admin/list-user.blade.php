@extends('admin.layouts.nav')

@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <a href="{{route('admin.users.index')}}" class="button">Voltar</a>
                <h3 class="text-center">Lista de Usuários</h3>
            </div>

            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>CPF</th>
                            <th>Criado em</th>
                            <th>Ultima modificação em</th>
                            <th>Detalhes</th>
                            <th>Deletar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{!! preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $user->cpf_number) !!}</td>
                                <td>{{$user->created_at->format('d/m/Y \á\s H:i')}}</td>
                                <td>{{$user->updated_at->format('d/m/Y \á\s H:i')}}</td>
                                <td><a href="{{route('admin.users.details', $user->id)}}"><span class="fi fi-eye"></span></a></td>
                                <td>
                                    <form action="{{route('admin.users.remove', $user->id)}}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn-link"><span class="fi fi-trash"></span></button>
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$users->links()}} 
            </div>
        </div>
    </div>    
@endsection