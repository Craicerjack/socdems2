<?php

namespace App;

use App\Box;
use App\Voter;

use Illuminate\Database\Eloquent\Model;

class address extends Model {
    public function voters() {
        return $this->hasMany(Voter::class);
    }
    public function box() {
        return $this->belongsTo(Box::class);
    }
}
