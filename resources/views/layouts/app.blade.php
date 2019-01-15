<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Egressos') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <div class="title-bar" data-responsive-toggle="menu-navigation" data-hide-for="medium">
            <button class="menu-icon" type="button" data-toggle="menu-navigation"></button>
            <div class="title-bar-title"></div>
        </div>

        <div class="top-bar" id="menu-navigation" data-animate="hinge-in-from-top spin-out">
            <div class="top-bar-left">
                <ul class="dropdown vertical medium-horizontal menu" data-responsive-menu="drilldown medium-dropdown">
                    <li class="menu-text"><a class="js-menu-topbar" href="{{route('user.home')}}">{{ config('app.name', 'Egressos') }}</a></li>
                </ul>
            </div>
            <div class="top-bar-right">
                <ul class="dropdown vertical medium-horizontal menu" data-responsive-menu="drilldown medium-dropdown">
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                    @else
                        <li role="menuitem"><a id="menu-events" class="js-menu-topbar" href="{{route('user.events.index')}}">Eventos</a></li>
                        <li ><a id="menu-news" class="js-menu-topbar" href="{{route('user.news.index')}}">Notícias</a></li>
                        <li><a id="menu-opportunities" class="js-menu-topbar" href="{{route('user.opportunities.index')}}">Oportunidades</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="menu vertical">
                                <li>
                                    <a href="{{ route('user.logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        Sair
                                    </a>

                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
       
        <div class="container">
            @include('layouts.messages')
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script> $(document).foundation();</script>
    <script src="{{ asset('js/topbar.js') }}"></script>
    @yield('scripts')
</body>
</html>
