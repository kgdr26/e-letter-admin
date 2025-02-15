<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materai extends Model
{
    protected $table = 'materai'; // Pastikan ini sesuai dengan nama tabel di database
    protected $fillable = ['jumlah', 'jenis', 'keterangan', 'user'];
}
