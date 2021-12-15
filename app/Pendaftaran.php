<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $guarded = ['id'];

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
