@extends('layouts.app')

@section('content')

<h2>{{ $kos->nama_kos }}</h2>

<p>{{ $kos->alamat }}</p>

<p>Rp {{ $kos->harga_min }}</p>

<p>{{ $kos->deskripsi }}</p>

<button>Wishlist</button>

<button>Booking</button>

@endsection