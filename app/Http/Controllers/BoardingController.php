<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoardingController extends Controller
{
    public function boarding()
    {
        return view('boarding.boarding');
    }

    public function akun()
    {
        return view('boarding.akun');
    }
}
