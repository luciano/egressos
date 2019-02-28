@extends('admin.layouts.nav')

@section('content')

<a href="{{ route('admin.users.list') }}" class="button radius bordered shadow">Voltar</a>

<div class="card container detail-user-container">
    <div class="card-section">
        <h4 class="separator-center">{{ $user->name }}</h4>
    </div>

    <div class="card-section detail-user-card">
        <section class="float-left">
            @if(!empty($student))
                <p> <strong>Matrícula:</strong>  {{$student->register}} </p>
            @endif
            <p> <strong>Email:</strong>  <a href="mailto:{{$user->email}}">{{$user->email}}</a> </p>
            <p> <strong>CPF:</strong>  {!! preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $user->cpf_number) !!} </p>
        </section>

        @if(!empty($student))
            <section class="float-right">
                @forelse ( $student_courses as $student_courses )
                    <p> <strong>Curso:</strong>  {{ $student_courses->course->name }} </p>
                    <p> <strong>Tipo:</strong>  {{ $student_courses->course->typ }} </p>
                    <p> <strong>Data conclusão:</strong>  {{ Carbon\Carbon::parse($student_courses->conclusion_date)->format('d/m/Y') }} </p>
                @empty
                @endforelse
            </section>
        @endif
    </div>

    <div class="card-section detail-user-card">
        @if(!empty($student))
            <section class="float-left">
                <p> <strong>Data de Nascimento:</strong>  {{ Carbon\Carbon::parse($student->bithday)->format('d/m/Y') }} </p>
                <p> <strong>Genero:</strong>  {{ $student->gender == 'M' ? 'Masculino' : 'Feminino' }} </p>
                @forelse ( $phones as $phone )
                    <p> <strong>Telefone:</strong>  {{ $phone->number }} </p>
                @empty
                @endforelse
            </section>

            <section class="float-right">
                <p> <strong>Rua:</strong>  {{ $address->street }} </p>
                <p> <strong>Bairro:</strong>  {{ $address->neighbor }} </p>
                <p> <strong>Cidade:</strong>  {{ $address->city }} </p>
                <p> <strong>Estado:</strong>  {{ $address->state }} </p>
                <p> <strong>CEP:</strong>  {{ $address->cep }} </p>
            </section>
        @endif
    </div>

    <div class="detail-user-foot-info">
        <span class="float-left">Criado em {{$user->created_at->format('d/m/Y')}}</span>
        <span class="float-right">Última modificação em {{$user->updated_at->format('d/m/Y')}}</span>
    </div>
</div>

<!-- - mexer no layout pra mostrar informacoes
- configrar layout da pagina de listar usuarios
- configurar layout de criar usuarios pra nao precisar preencher se for fazer por upload -->

@endsection