<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{
    use HasFactory;

    public $timestamps = true;
    
    public function users()
    {
        return $this->hasMany('App\Models\User', 'consultant_id', 'id');
    }
}
