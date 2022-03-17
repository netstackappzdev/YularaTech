<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_id','name', 'gender','user_id',
    ];

    public function users() {
        return $this->belongsTo('App\Models\User');
    }
}
 