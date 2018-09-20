@extends('admin.layouts.nav')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Gráficos dos Dados</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    Mostrar coisas aqui!

                    Use it <a href="http://lavacharts.com/#install" target="_blank">Larachart</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
