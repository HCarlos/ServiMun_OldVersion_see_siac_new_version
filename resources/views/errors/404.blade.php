@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message')

    <div class="auth-brand m-2 ">
        <a href="/" >
            <span><img src="{{ asset('images/web/logo-1.png') }} " alt=""></span>
        </a>
    </div>

    <p>Página no encontrada. <br/>Contacte al administrador</p><br>

    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault();
             document.getElementById('logout-form').submit();" >
        {{ __('Logout') }}
    </a>
    <br>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

@endsection
