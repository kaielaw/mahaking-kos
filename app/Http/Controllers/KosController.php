<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Kos;

class KosController extends Controller
{
    public function index()
    {
        $dataKos = Kos::all();

        return view('kos.index', compact('dataKos'));
    }
}