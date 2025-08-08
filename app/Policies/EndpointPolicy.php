<?php

namespace App\Policies;

use App\Models\Endpoint;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EndpointPolicy
{

    public function view(User $user, Endpoint $endpoint)
    {
        return $user->id === $endpoint->user_id
        ? Response::allow()
        : Response::deny('You do not own this endpoint.');
    }

    public function update(User $user, Endpoint $endpoint)
    {
        return $user->id === $endpoint->user_id
        ? Response::allow()
        : Response::deny('You do not own this endpoint.');
    }

    public function delete(User $user, Endpoint $endpoint) {
        return $user->id === $endpoint->user_id
            ? Response::allow()
            : Response::deny('You do not own this endpoint.');
    }
}
