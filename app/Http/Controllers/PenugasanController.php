<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PegawaiPenugasan;
use App\Models\Penugasan;
use Illuminate\Http\Request;

class PenugasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Penugasan::with('pegawai')->orderByDesc('id')->get();
        return view('penugasan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penugasan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'jenis' => 'required|string',
            'kategori' => 'required|string',
            'tanggal' => 'required',
            'jumlah_asn' => 'required|numeric',
            'jumlah_outsourching' => 'required|numeric',
            'jumlah_titik_acara' => 'required|numeric',
            'tingkat_kesulitan' => 'required|string',
        ]);

        $penugasan = Penugasan::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
            'jumlah_asn' => $request->jumlah_asn,
            'jumlah_outsourching' => $request->jumlah_outsourching,
            'jumlah_titik_acara' => $request->jumlah_titik_acara,
            'tingkat_kesulitan' => $request->tingkat_kesulitan,
        ]);

        foreach($request->pegawai as $peg) {
            PegawaiPenugasan::create([
                'pegawai_id' => $peg,
                'penugasan_id' => $penugasan->id,
            ]);
        }

        return redirect()->route('penugasan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penugasan  $penugasan
     * @return \Illuminate\Http\Response
     */
    public function show(Penugasan $penugasan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penugasan = Penugasan::with('pegawai')->find($id);
        $pegawai = Pegawai::where('kekuatan', $penugasan->tingkat_kesulitan)->get();
        return view('penugasan.edit', compact('penugasan', 'pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $penugasan = Penugasan::find($id);
        $penugasan->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
            'jumlah_asn' => $request->jumlah_asn,
            'jumlah_outsourching' => $request->jumlah_outsourching,
            'jumlah_titik_acara' => $request->jumlah_titik_acara,
            'tingkat_kesulitan' => $request->tingkat_kesulitan,
        ]);

        PegawaiPenugasan::where('penugasan_id', $penugasan->id)->delete();

        foreach($request->pegawai as $peg) {
            PegawaiPenugasan::create([
                'pegawai_id' => $peg,
                'penugasan_id' => $penugasan->id,
            ]);
        }

        return redirect()->route('penugasan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PegawaiPenugasan::where('penugasan_id', $id)->delete();
        $penugasan = Penugasan::find($id);
        $penugasan->delete();

        return redirect()->route('penugasan.index');
    }
}
