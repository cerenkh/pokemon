<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = ['pokemon_id', 'name', 'experience'];

    public function users(){

        return $this->belongsToMany(User::class);
    }
}