<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'patients';
    protected $fillable = ['user_id', 'pid', 'sex', 'address', 'contact'];

    //Patient belongs to user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pemeriksaan()
    {
        return $this -> hasMany(Pemeriksaan::class);
    }

}
