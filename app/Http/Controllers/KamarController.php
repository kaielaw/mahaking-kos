<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Kamar;

class KamarController extends Controller
{
    public function index()
    {
        $dataKamar = Kamar::all();

        return view('kamar.index', compact('dataKamar'));
    }
}