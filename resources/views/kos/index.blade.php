@extends('layouts.app')

@section('content')

<h2>Daftar Kos</h2>

@foreach ($dataKos as $kos)

    <div>
        <h3>{{ $kos->nama_kos }}</h3>

        <p>Alamat: {{ $kos->alamat }}</p>

        <p>Harga Minimum: Rp {{ $kos->harga_min }}</p>

        <hr>
    </div>

@endforeach

@endsection