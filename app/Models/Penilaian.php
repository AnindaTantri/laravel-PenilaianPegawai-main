<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'penilaian';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'penugasan_id', 
        'pegawai_id', 
        'penilai_id',
        'etika',
        'disiplin',
        'tanggung_jawab',
        'teamwork',
        'problem_solve',
        'kepatuhan',
        'kejujuran',
        'inisiatif',
        'komunikasi',
        'perencanaan',
        'kepemimpinan',
        'inovasi',
        'analisa_pemikiran',
    ];

    /**
     * Get the pegawai that owns the Penilaian
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
