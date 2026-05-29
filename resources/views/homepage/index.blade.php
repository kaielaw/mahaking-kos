@extends('layouts.app')

@section('content')

<h1>Mahaking Kos</h1>

<p>Cari kos terbaik untuk kebutuhanmu</p>

<hr>

<h2>Search Bar</h2>

<form>
    <input type="text" placeholder="Cari kos...">
    <button type="submit">Cari</button>
</form>

<hr>

<h2>Rekomendasi Kos</h2>

<p>Nanti looping data kos di sini</p>

<hr>

<h2>Feature Section</h2>

<ul>
    <li>Booking Online</li>
    <li>Wishlist Kos</li>
    <li>Review Pengguna</li>
</ul>

@endsection