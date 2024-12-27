<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    protected $table = 'penyakit';
    protected $guarded = ['id'];
    public function rule()
    {
        return $this->hasMany(Rule::class, 'penyakit_id');
    }

    public function gejala()
    {
        return $this->hasMany(Gejala::class);
    }
}
