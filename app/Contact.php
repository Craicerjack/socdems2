<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name'];

    /**
     * Get the user that owns the task.
     */
    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class);
    }
    public function voter()
    {
        return $this->belongsTo(Voter::class);
    }
}
