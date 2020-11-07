<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use TCG\Voyager\Policies\BasePolicy;

class ProductPolicy extends BasePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function add(User $user, $product)
    {
        return $product->store->user_id === $user->id;
    }

    public function edit(User $user, $product)
    {
        return $product->store->user_id === $user->id;
    }
}
