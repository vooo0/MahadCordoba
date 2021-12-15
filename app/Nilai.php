<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $guarded = ['id'];

    public function matapelajaran()
    {
        return $this->BelongsTo(Matapelajaran::class);
    }

    public function guru()
    {
        return $this->HasMany(Guru::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->HasMany(Kelas::class);
    }

    public function tahun()
    {
        return $this->BelongsTo(Tahun::class);
    }
}
