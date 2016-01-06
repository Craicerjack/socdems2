<?php

namespace App;

use Illuminate\Foundation\Auth\Volunteer as Authenticatable;

class Volunteer extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
