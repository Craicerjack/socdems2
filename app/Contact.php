<?php

namespace App;

use App\User;
use App\Voter;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    /**
     * Get the user that owns the task.
     */
    public function volunteer()
    {
        return $this->belongsTo(User::class);
    }
    public function voter()
    {
        return $this->belongsTo(Voter::class);
    }
}
