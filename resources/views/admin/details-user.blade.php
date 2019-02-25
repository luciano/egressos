@extends('admin.layouts.nav')

@section('content')

<div class="card container">
    <div class="card-section">
        <h4 class="text-center">{{ $user->name }}</h4>
        <hr>
        <p>{{$user->email}}</p>
        <p>{{$user->cpf_number}}</p>
    </div>

    <div class="card-section">
        
    </div>
</div>

@if(!empty($student))
    <p>
    <strong>student:</strong>  {{$student}}
    </p>

    <p>
    <strong>address:</strong>  {{ $address->street }}
    </p>

    <p>
    <!-- array -->
    <strong>phone:</strong>  {{$phones}}
    </p>

    <p>
    <!-- array -->
    <strong>student_course:</strong>  {{$student_courses[0]}}
    </p>

    <p>
    <strong>course:</strong>  {{ $student_courses[0]->course }}
    </p>    
@endif

@endsection