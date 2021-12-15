<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $guarded = ['id'];

    public function matapelajaran()
    {
        return $this->BelongsTo(Matapelajaran::class);
    }
    
    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
    
    public function nilai()
    {
        return $this->BelongsTo(Nilai::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function tahun()
    {
        return $this->BelongsTo(Tahun::class);
    }
}
