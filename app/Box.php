<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name'];

    public function voters()
    {
        return $this->hasMany(Voter::class);
    }
}
