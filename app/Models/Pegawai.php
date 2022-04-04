<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pegawai';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 
        'jabatan', 
        'status', 
        'jumlah_dinas', 
        'nilai_dinas', 
        'administrasi', 
        'kekuatan',
        'jenis_kelamin',
    ];

    /**
     * The penugasan that belong to the Pegawai
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function penugasan()
    {
        return $this->belongsToMany(Penugasan::class, 'pegawai_penugasan', 'pegawai_id', 'penugasan_id');
    }
}
