@extends('layouts.app')

@if (auth()->user()->created_at == auth()->user()->updated_at)
    @section('content')    
        <div class="container">
            @component('components.questions')
            @endcomponent
        </div>
    @endsection
@else
    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">USER Dashboard</div>

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
@endif