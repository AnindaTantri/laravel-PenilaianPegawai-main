<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiPenugasan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pegawai_penugasan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['pegawai_id', 'penugasan_id'];
}
