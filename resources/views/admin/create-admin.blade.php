@extends('admin.layouts.nav')

@section('content')
    <p>Admin in the system</p>
    <a href="{{route('admin.users.index')}}" class="btn btn-default">Voltar</a>
@endsection