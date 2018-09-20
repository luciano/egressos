@extends('admin.layouts.nav')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Gerenciar Usuários</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="btn-group">
                        <a href="{{ route('admin.users.register') }}" class="btn btn-primary">Criar Usuário</a>
                        <a href="{{ route('user.home') }}" target="_blank" class="btn btn-default">Ir pra Login de Usuário</a>
                    </div>
                    <a href="{{ route('admin.admins.register') }}" class="btn btn-primary">Criar Administrador</a>

                    <br><br>
                    
                    <a href="{{ route('admin.users.list') }}" class="btn btn-default">Listar Usuários</a>
                    <a href="{{ route('admin.admins.list') }}" class="btn btn-default">Listar Administradores</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
