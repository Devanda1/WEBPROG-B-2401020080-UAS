<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Halaman HOME (PUBLIK)
     * Tidak pakai middleware auth
     */
    public function index()
    {
        return view('home');
    }
}
