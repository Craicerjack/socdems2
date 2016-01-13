<?php

namespace App;

use App\User;
use App\Address;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    protected $fillable = ['date', 'result', 'support_lvl', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
