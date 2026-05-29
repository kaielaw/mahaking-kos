@extends('layouts.app')

@section('content')

<h2>List Kos</h2>

<input type="text" placeholder="Cari kos">

<select>
    <option>Semua Jenis</option>
    <option>Putra</option>
    <option>Putri</option>
</select>

<hr>

@foreach ($dataKos as $kos)

    <div>

        <h3>{{ $kos->nama_kos }}</h3>

        <p>{{ $kos->alamat }}</p>

        <p>Rp {{ $kos->harga_min }}</p>

        <a href="/kos/{{ $kos->id_kos }}">
            Detail
        </a>

    </div>

    <hr>

@endforeach

@endsection