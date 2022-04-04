<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePenilaianRequest;
use App\Http\Requests\UpdatePenilaianRequest;
use App\Models\Penilaian;
use App\Models\Penugasan;
use Illuminate\Http\Request;
use DB;

class PenilaianController extends Controller
{
    private function personilMale() 
    {
        return Penilaian::join('pegawai', 'penilaian.pegawai_id', '=', 'pegawai.id')
            ->where('pegawai.jabatan', 'personil')
            ->where('pegawai.jenis_kelamin', 'L')
            ->select(
                'pegawai.*',
                DB::raw('(sum(etika) + sum(disiplin) + sum(tanggung_jawab) + sum(teamwork) + sum(problem_solve) + sum(kepatuhan) + sum(kejujuran) + sum(inisiatif) + sum(komunikasi)) / (count(pegawai_id) * 9) as total'),
            )
            ->groupBy('pegawai_id')
            ->get();
    }

    private function personilFemale()
    {
        return Penilaian::join('pegawai', 'penilaian.pegawai_id', '=', 'pegawai.id')
            ->where('pegawai.jabatan', 'personil')
            ->where('pegawai.jenis_kelamin', 'P')
            ->select(
                'pegawai.*',
                DB::raw('(sum(etika) + sum(disiplin) + sum(tanggung_jawab) + sum(teamwork) + sum(problem_solve) + sum(kepatuhan) + sum(kejujuran) + sum(inisiatif) + sum(komunikasi)) / (count(pegawai_id) * 9) as total'),
            )
            ->groupBy('pegawai_id')
            ->get();
    }

    private function dantimMale()
    {
        return Penilaian::join('pegawai', 'penilaian.pegawai_id', '=', 'pegawai.id')
            ->where('pegawai.jabatan', 'dantim')
            ->where('pegawai.jenis_kelamin', 'L')
            ->select(
                'pegawai.*',
                DB::raw('(sum(etika) + sum(disiplin) + sum(tanggung_jawab) + sum(teamwork) + sum(problem_solve) + sum(perencanaan) + sum(kejujuran) + sum(kepemimpinan) + sum(inovasi) + sum(analisa_pemikiran)) / (count(pegawai_id) * 10) as total'),
            )
            ->groupBy('pegawai_id')
            ->get();
    }

    private function dantimFemale()
    {
        return Penilaian::join('pegawai', 'penilaian.pegawai_id', '=', 'pegawai.id')
            ->where('pegawai.jabatan', 'dantim')
            ->where('pegawai.jenis_kelamin', 'P')
            ->select(
                'pegawai.*',
                DB::raw('(sum(etika) + sum(disiplin) + sum(tanggung_jawab) + sum(teamwork) + sum(problem_solve) + sum(perencanaan) + sum(kejujuran) + sum(kepemimpinan) + sum(inovasi) + sum(analisa_pemikiran)) / (count(pegawai_id) * 10) as total'),
            )
            ->groupBy('pegawai_id')
            ->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = $this->personilMale()->merge($this->dantimMale())->merge($this->personilFemale())->merge($this->dantimFemale())->sortByDesc('total');
        return view('penilaian.index', compact('pegawai'));
    }

    public function home()
    {
        $penugasan = Penugasan::orderByDesc('id')->get();
        $males = $this->personilMale()->merge($this->dantimMale())->sortByDesc('total');
        $females = $this->personilFemale()->merge($this->dantimFemale())->sortByDesc('total');

        $male = (collect($males))->take(5);
        $female = (collect($females))->take(5);

        return view('penilaian.home', compact('penugasan', 'male', 'female'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param   int $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $penugasan = Penugasan::with('pegawai')->find($id);
        return view('penilaian.create', compact('penugasan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Penilaian::create($request->all());
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Penilaian::join('pegawai', 'penilaian.pegawai_id', '=', 'pegawai.id')
            ->select(
                'pegawai.*',
                DB::raw('sum(etika) / count(pegawai_id) as etika'),
                DB::raw('sum(disiplin) / count(pegawai_id) as disiplin'),
                DB::raw('sum(tanggung_jawab) / count(pegawai_id) as tanggung_jawab'),
                DB::raw('sum(teamwork) / count(pegawai_id) as teamwork'),
                DB::raw('sum(problem_solve) / count(pegawai_id) as problem_solve'),
                DB::raw('sum(kepatuhan) / count(pegawai_id) as kepatuhan'),
                DB::raw('sum(kejujuran) / count(pegawai_id) as kejujuran'),
                DB::raw('sum(inisiatif) / count(pegawai_id) as inisiatif'),
                DB::raw('sum(komunikasi) / count(pegawai_id) as komunikasi'),
                DB::raw('sum(perencanaan) / count(pegawai_id) as perencanaan'),
                DB::raw('sum(kepemimpinan) / count(pegawai_id) as kepemimpinan'),
                DB::raw('sum(inovasi) / count(pegawai_id) as inovasi'),
                DB::raw('sum(analisa_pemikiran) / count(pegawai_id) as analisa_pemikiran'),
                DB::raw('count(pegawai_id) as count'),
            )
            ->where('pegawai_id', $id)->get();
        return view('penilaian.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(Penilaian $penilaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenilaianRequest  $request
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenilaianRequest $request, Penilaian $penilaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penilaian $penilaian)
    {
        //
    }
}
