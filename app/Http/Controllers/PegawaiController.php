<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePegawaiRequest;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pegawai::orderbyDesc('id')->get();
        return view('employee.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
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
            'jabatan' => 'required|string',
            'status' => 'required|string',
            'jumlah_dinas' => 'required|numeric',
            'nilai_dinas' => 'required|numeric',
            'administrasi' => 'required|string',
            'kekuatan' => 'required|string',
            'jenis_kelamin' => 'required|string',
        ]);

        Pegawai::create($request->all());

        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
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
        $pegawai = Pegawai::find($id);
        return view('employee.edit', compact('pegawai'));
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
        $request->validate([
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'status' => 'required|string',
            'jumlah_dinas' => 'required|numeric',
            'nilai_dinas' => 'required|numeric',
            'administrasi' => 'required|string',
            'kekuatan' => 'required|string',
            'jenis_kelamin' => 'required|string',
        ]);

        $pegawai = Pegawai::find($id);
        $pegawai->update($request->all());

        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();
        
        return redirect()->route('employees.index');
    }

    public function getPegawaiByKekuatan($kesulitan)
    {
        $data = Pegawai::where('kekuatan', $kesulitan)->get();
        return $data;
    }

    public function getJabatanById($id)
    {
        $data = Pegawai::select('jabatan')->find($id);
        return $data;
    }
}
