<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Penugasan;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pegawai = Pegawai::count();
        $penugasan = Penugasan::count();
        return view('home', compact('pegawai', 'penugasan'));
    }
}
