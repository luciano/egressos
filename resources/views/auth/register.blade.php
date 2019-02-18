@extends('admin.layouts.nav')

@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3>Adicionar novo Usuário <a href="{{route('admin.users.index')}}" class="button pull-right">Voltar</a></h3>
            </div>

            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('admin.users.register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nome</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cpf_number') ? ' has-error' : '' }}">
                                <label for="cpf_number" class="col-md-4 control-label">CPF</label>
    
                                <div class="col-md-6">
                                    <input id="cpf_number" type="cpf_number" class="form-control" name="cpf_number" value="{{ old('cpf_number') }}" required>
    
                                    @if ($errors->has('cpf_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cpf_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirma Senha</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 pull-right">
                                <button type="submit" class="button success">
                                    Salvar
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- ok -->
                    <label for="file-upload" class="custom-file-upload button warning">
                        <i class="fi-upload-cloud"></i> Importar dados de arquivo
                    </label>
                    {{Form::file('lista', ['id' => 'file-upload', 'accept' => '.csv'])}}
                    <span id='file-name' class="file-name-input"></span>
            </div>
        </div>
    </div>    
@endsection

@section('scripts')
<script src="{{ asset('js/register.js') }}"></script>
@endsection