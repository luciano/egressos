@extends('layouts.app')

@section('content')
    <form class="log-in-form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <h4 class="text-center">Entrar</h4>
        
        <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">E-mail
                <input id="email" type="email" name="email" autocomplete="username email" value="{{ old('email') }}" required autofocus placeholder="enderecoemail@email.com">
            </label>
            <div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="password-wrapper {{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">Senha</label>
            <input id="password" type="password" name="password" class="password" autocomplete="current-password" placeholder="senha" required>
            <button class="unmask" type="button">Unmask</button>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <p><input type="submit" class="button expanded" value="Entrar"></p>
        <p class="text-center"><a class="btn btn-link" href="{{ route('password.request') }}">Esqueceu a senha?</a></p>
    </form>
@endsection

@section('scripts')
<script src="{{ asset('js/login.js') }}"></script>
@endsection