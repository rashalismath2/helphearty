<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public $timestamps = true;

    public function consultant()
    {
        return $this->belongsTo('App\Models\Consultant', 'cons_id', 'id');
    }
    public function answers()
    {
        return $this->hasMany('App\Models\Answer', 'question_id', 'id');
    }
}
