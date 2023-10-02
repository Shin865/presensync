<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoardingController extends Controller
{
    public function index()
    {
        return view('boarding.boarding');
    }
}
