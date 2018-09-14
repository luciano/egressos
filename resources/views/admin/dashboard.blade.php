@extends('admin.layouts.nav')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ADMIN Dashboard Novo</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @component('components.who')    
                    @endcomponent

                    <a href="{{ route('admin.create.user') }}" class="btn btn-primary">Criar Usuário</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
