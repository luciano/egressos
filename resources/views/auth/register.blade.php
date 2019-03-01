@extends('admin.layouts.nav')

@section('content')

    <a href="{{route('admin.users.index')}}" class="button radius bordered shadow">Voltar</a>

    <h3 class="text-center">Adicionar Usuários</h3>

    <div class="grid-container grid-padding-x align-center-middle text-center add-user-container">
        <div class="grid-x grid-margin-x">
            <div class="cell small-4 add-user-from-file">
                <form class="form-horizontal" method="POST" action="{{ route('admin.users.register') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <!-- ok -->
                    <label for="file-upload" class="custom-file-upload button radius bordered shadow warning">
                        <i class="fi-upload-cloud"></i> Importar Dados
                    </label>
                    <input type='file' name='lista-usuarios' id='file-upload' accept='.json'>
                    <span id='file-name' class="file-name-input"></span><br>

                    <button type="submit" class="button radius bordered shadow text-center">OK</button>
                </form>
            </div>
            <div class="cell large-auto callout large">
                <!-- - fazer essa parte do layout do form
                - fazer o import sem precisar de preencher form
                - dar um output do q foi inserido, do que ja tinha sido inserido, ou se nao foi inserido os dados
                -  -->
                <form class="form-horizontal" method="POST" action="{{ route('admin.users.register') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="grid-x grid-padding-x {{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="small-3 cell">
                            <label for="name" class="text-right middle">Nome</label>
                        </div>
                        <div class="small-9 cell">
                            <input id="name" type="text" placeholder="Digite o nome do usuário" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <p class="help-text help-text-error">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="grid-x grid-padding-x">
                        <div class="small-3 cell">
                            <label for="middle-label" class="text-right middle">E-mail</label>
                        </div>
                        <div class="small-9 cell">
                            <input type="text" id="middle-label" placeholder="Right- and middle-aligned text input">
                            <p class="help-text help-text-error" id="passwordHelpText">Your password must have at least 10 characters, a number, and an Emoji.</p>
                        </div>
                    </div>

                    <div class="grid-x grid-padding-x">
                        <div class="small-3 cell">
                            <label for="middle-label" class="text-right middle">CPF</label>
                        </div>
                        <div class="small-9 cell">
                            <input type="text" id="middle-label" placeholder="Right- and middle-aligned text input">
                        </div>
                    </div>

                    <div class="grid-x grid-padding-x">
                        <div class="small-3 cell">
                            <label for="middle-label" class="text-right middle">Senha</label>
                        </div>
                        <div class="small-9 cell">
                            <input type="text" id="middle-label" placeholder="Right- and middle-aligned text input">
                        </div>
                    </div>

                    <div class="grid-x grid-padding-x">
                        <div class="small-3 cell">
                            <label for="middle-label" class="text-right middle">Confirmar Senha</label>
                        </div>
                        <div class="small-9 cell">
                            <input type="text" id="middle-label" placeholder="Right- and middle-aligned text input">
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

            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/register.js') }}"></script>
@endsection