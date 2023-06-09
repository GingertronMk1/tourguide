<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\AccessEquipment;
use App\Models\User;

class AccessEquipmentPolicy
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
    public function view(User $user, AccessEquipment $accessEquipment): bool
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
    public function update(User $user, AccessEquipment $accessEquipment): bool
    {
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AccessEquipment $accessEquipment): bool
    {
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AccessEquipment $accessEquipment): bool
    {
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AccessEquipment $accessEquipment): bool
    {
    }
}
