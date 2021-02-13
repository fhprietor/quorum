<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
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
        return $user->can('listar questions');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User  $user
     * @param Question $question
     * @return mixed
     */
    public function view(User $user, Question $question)
    { return true;
      //  if ($user->can('mostrar questions')) return true;

       // return $user->id === $question->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('crear questions');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Question $question
     * @return mixed
     */
    public function update(User $user, Question $question)
    {
        return $user->can('actualizar questions');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Question $question
     * @return mixed
     */
    public function delete(User $user, Question $question)
    {
        return $user->can('borrar questions');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Question $question
     * @return mixed
     */
    public function restore(User $user, Question $question)
    {
        return $user->can('restaurar questions');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Question $question
     * @return mixed
     */
    public function forceDelete(User $user, Question $question)
    {
        //
    }
}
