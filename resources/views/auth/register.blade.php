@extends('layouts.app')

@section('content')

<h2>Register</h2>

<form>

    <input type="text" placeholder="Nama">

    <br><br>

    <input type="email" placeholder="Email">

    <br><br>

    <input type="password" placeholder="Password">

    <br><br>

    <select>
        <option>User</option>
        <option>Pemilik</option>
    </select>

    <br><br>

    <button type="submit">Register</button>

</form>

@endsection