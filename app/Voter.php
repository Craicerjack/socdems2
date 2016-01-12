<?php

namespace App;

use App\Contact;
use App\Address;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model {
    protected $fillable = ['name'];

    /**
     * Get the user that owns the task.
     */
    public function contacts() {
        return $this->hasMany(Contact::class);
    }

    public function address() {
        return $this->belongsTo(Address::class);
    }

}
