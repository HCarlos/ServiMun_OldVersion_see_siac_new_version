@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message')
    <p>No tiene permisos para ingresar. Contacte al administrador</p>
    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

@endsection
