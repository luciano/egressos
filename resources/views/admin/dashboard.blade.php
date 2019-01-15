@extends('admin.layouts.nav')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ADMIN Dashboard Novo</div>
                <i class="fi-heart style3"></i>


                <div class="success callout" data-closable>
                    <p>usar nos alertas</p>
                    <p>You can so totally close this!</p>
                    <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @component('components.who')    
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
