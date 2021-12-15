<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{   
    protected $guarded = ['id'];

    public function kelas()
    {
        return $this->BelongsTo(kelas::class);
    }
}
