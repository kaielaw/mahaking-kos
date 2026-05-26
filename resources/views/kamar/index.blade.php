@extends('layouts.app')

@section('content')

<h2>Daftar Kamar</h2>

@foreach ($dataKamar as $kamar)

    <div>
        <p>ID Kamar: {{ $kamar->id_kamar }}</p>

        <p>Harga per bulan: Rp {{ $kamar->harga_per_bulan }}</p>

        <hr>
    </div>

@endforeach

@endsection