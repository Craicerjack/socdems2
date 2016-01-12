<?php

namespace App;

use App\User;
use App\Address;
use Illuminate\Database\Eloquent\Model;

class Box extends Model {
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name'];

    public function voters() {
        return $this->hasMany(Address::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
