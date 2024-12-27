<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    protected $table = 'gejala';
    protected $guarded = ['id'];
    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }
}
