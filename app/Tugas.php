<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $guarded = ['id'];

    public function matapelajaran()
    {
        return $this->BelongsTo(Matapelajaran::class);
    }

    public function guru()
    {
        return $this->BelongsTo(Guru::class);
    }

    public function siswa()
    {
        return $this->BelongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function tahun()
    {
        return $this->BelongsTo(Tahun::class);
    }
}
