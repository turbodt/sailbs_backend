<?php

namespace App\Policies;

use App\User;
use App\Certificate;

class SubjectPolicy
{
    public function get(?User $user)
    {
        return true;
    }

    public function create(?User $user) {
        return $user->hasRole('admin');
    }

    public function update(?User $user) {
        return $user->hasRole('admin');
    }

    public function delete(?User $user) {
        return $user->hasRole('admin');
    }

}