<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
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

    /**
     * Is this note belongs to the User?
     *
     * @param  User  $user
     * @param  Note  $note
     * @return bool
     */
    public function isUserNote(User $user, Note $note): bool
    {
        return $note->user_id === $user->id;
    }
}
