<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Car;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Car $car)
    {
        return $user->id === $car->b_user_id;
    }

    public function delete(User $user, Car $car)
    {
        return $user->id === $car->b_user_id;
    }

    public function viewAvailability(User $user, Car $car)
    {
        return $user->id === $car->b_user_id;
    }

    public function manageAvailability(User $user, Car $car)
    {
        return $user->id === $car->b_user_id;
    }
}
