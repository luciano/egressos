@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert success">
        {{ session('status') }}
    </div>
@endif

<form class="log-in-form" method="POST" action="{{ route('password.email') }}">
    {{ csrf_field() }}

    <h4 class="text-center">Esqueci a senha</h4>
    
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

    <p><input type="submit" class="button expanded" value="Confirmar"></p>
</form>
@endsection
