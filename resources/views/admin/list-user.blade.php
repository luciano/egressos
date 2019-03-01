@extends('admin.layouts.nav')

@section('content')

    <a href="{{route('admin.users.index')}}" class="button radius bordered shadow">Voltar</a>

    <h3 class="text-center">Listar Usuários</h3>

    @if(empty($users))
    <div class="grid-x grid-margin-x">
        <div class="cell large-auto">
            <label>Escolha curso:
                <select name="course">
                    <option value="all">Todos</option>
                    @foreach( $courses as $course )
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </label>
        </div>

        <div class="cell large-auto">
            <label>Escolha tipo de curso:
                <select name="typ">
                    <option value="all">Todos</option>
                    @foreach( $courses as $course )
                        <option value="{{ $course->typ }}">{{ $course->typ }}</option>
                    @endforeach
                </select>
            </label>
        </div>

        <div class="cell small-2">
            <label>Escolha ano:
                <select name="year">
                    <option value="all">Todos</option>
                    @for ($year = (int) Carbon\Carbon::now()->year; $year > Carbon\Carbon::now()->year - 8; $year--)
                        <option value="{{$year}}">{{$year}}</option>
                    @endfor
                </select>
            </label>
        </div>

        <div class="cell small-2"><a id="search-user" href="{{route('admin.users.list') }}" class="button radius bordered shadow warning">Buscar</a></div>
    </div>      
    @endif

    @section('info-user')
        <div class="info-user">
            @if(!empty($users))
                @if( $users->count() > 0)
                    <table class="hover table-list-info-user">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>CPF</th>
                                <th>Criado em</th>
                                <th>Última modificação em</th>
                                <th>Detalhes</th>
                                <th>Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td class="text-left">{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{!! preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $user->cpf_number) !!}</td>
                                    <td>{{$user->created_at->format('d/m/Y \á\s H:i')}}</td>
                                    <td>{{$user->updated_at->format('d/m/Y \á\s H:i')}}</td>
                                    <td><a href="{{route('admin.users.details', $user->id)}}" target="_blank"><i class="fi-eye"></i></a></td>
                                    <td>
                                        <form action="{{route('admin.users.remove', $user->id)}}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn-link"><i class="fi-trash"></i></button>
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                @else
                    <div class="callout large alert callout-no-result">
                        <h5 class="text-center">Nenhum resultado encontrado!</h5>
                    </div>
                @endif
            @endif   
        </div>
    @show
@endsection

@section('scripts')
    <script src="{{ asset('js/list-users.js') }}"></script>
@endsection