<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Menu;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Menu $menu)
    {
        return $user->id === $menu->merchant->user_id;
    }

    public function delete(User $user, Menu $menu)
    {
        return $user->id === $menu->merchant->user_id;
    }
}
