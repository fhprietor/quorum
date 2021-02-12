<?php

namespace App\Policies;

use App\Models\Reunion;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReunionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('listar reuniones');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User  $user
     * @param Reunion $reunion
     * @return mixed
     */
    public function view(User $user, Reunion $reunion)
    {
        if ($user->can('mostrar reuniones')) return true;

        return $user->id === $reunion->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('crear reuniones');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Reunion $reunion
     * @return mixed
     */
    public function update(User $user, Reunion $reunion)
    {
          return $user->can('actualizar reuniones');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Reunion $reunion
     * @return mixed
     */
    public function delete(User $user, Reunion $reunion)
    {
        return $user->can('borrar reuniones');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Reunion $reunion
     * @return mixed
     */
    public function restore(User $user, Reunion $reunion)
    {
        return $user->can('restaurar reuniones');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Reunion $reunion
     * @return mixed
     */
    public function forceDelete(User $user, Reunion $reunion)
    {
        //
    }
}
