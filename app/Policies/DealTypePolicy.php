<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\DealType;
use App\Models\User;

class DealTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DealType $dealType): bool
    {
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DealType $dealType): bool
    {
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DealType $dealType): bool
    {
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DealType $dealType): bool
    {
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DealType $dealType): bool
    {
    }
}
