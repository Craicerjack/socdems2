<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    protected $fillable = ['name'];

    /**
     * Get the user that owns the task.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
    public function box()
    {
        return $this->belongsTo(Box::class);
    }
}
