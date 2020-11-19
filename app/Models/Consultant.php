<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Consultant extends Authenticatable
{
    use HasFactory,HasApiTokens;

    public $timestamps = true;
    
    public function users()
    {
        return $this->hasMany('App\Models\User', 'consultant_id', 'id');
    }
    public function questions()
    {
        return $this->hasMany('App\Models\Question', 'cons_id', 'id');
    }

  

}
