@extends('layouts.app')

@section('content')

<h2>Login</h2>

<form>

    <input type="text" placeholder="Email / No HP">

    <br><br>

    <input type="password" placeholder="Password">

    <br><br>

    <button type="submit">Login</button>

</form>

<p>Belum punya akun?</p>

<a href="/register">Register</a>

@endsection