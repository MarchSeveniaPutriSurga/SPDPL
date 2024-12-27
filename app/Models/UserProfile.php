<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profile';
    protected $fillable = ['user_id', 'gender', 'umur', 'telepon'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getUmurAttribute($value)
    {
        return $value . ' tahun'; // Contoh: "25" -> "25 tahun"
    }

    public function getGenderAttribute($value)
    {
        return ucwords($value);
    }

}
