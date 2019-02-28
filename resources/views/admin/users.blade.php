@extends('admin.layouts.nav')

@section('content')

    <h3 class="text-center">Gerenciar Usuários</h3>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <br>
    <div class="button-group">
        <a href="{{ route('admin.admins.register') }}" class="button radius bordered shadow warning">Criar Administrador</a>
        <a href="{{ route('admin.admins.list') }}" class="button radius bordered shadow warning">Listar Administradores</a>        
    </div>

    <br><br>

    <div class="button-group">
        <a href="{{ route('admin.users.register') }}" class="button radius bordered shadow success">Criar Usuário</a>
        <a href="{{ route('user.home') }}" target="_blank" class="button radius bordered shadow secondary">Ir pra Login de Usuário</a>
        <a href="{{ route('admin.users.list') }}" class="button radius bordered shadow primary">Listar Usuários</a>
    </div>

@endsection
