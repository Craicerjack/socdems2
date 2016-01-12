<?php

namespace App\Repositories;

use App\User;
use App\Contact;

class ContactRepository {
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function getContacts() {
        return Contact::orderBy('created_at', 'asc')->get();
    }
}