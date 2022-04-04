<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'penugasan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 
        'jenis', 
        'kategori', 
        'tanggal', 
        'jumlah_asn', 
        'jumlah_outsourching', 
        'jumlah_titik_acara', 
        'tingkat_kesulitan'
    ];

    /**
     * The pegawai that belong to the Penugasan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pegawai()
    {
        return $this->belongsToMany(Pegawai::class, 'pegawai_penugasan', 'penugasan_id', 'pegawai_id');
    }
}
