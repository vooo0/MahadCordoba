<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $guarded = ['id'];
    
    public function matapelajaran()
    {
        return $this->BelongsTo(Matapelajaran::class);
    }

    public function tugas()
    {
        return $this->BelongsTo(Tugas::class);
    }

    public function nilai()
    {
        return $this->BelongsTo(Nilai::class);
    }

    public function kelas()
    {
        return $this->BelongsTo(Kelas::class);
    }
    
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function gaji()
    {
        return $this->HasMany(Gaji::class);
    }


}
