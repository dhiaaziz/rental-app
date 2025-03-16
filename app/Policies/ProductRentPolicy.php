<?php

namespace App\Policies;

use App\Models\ProductRent;
use App\Models\User;

class ProductRentPolicy
{
    /**
     * View any product rents? Typically only admin/root-admin.
     */
    public function viewAny(User $user)
    {
        // Admin + Root Admin
        return $user->hasAnyRole(['admin', 'root-admin']);
    }

    /**
     * View a specific product rent.
     */
    public function view(User $user, ProductRent $productRent)
    {
        // Admin, Root Admin, or the user who created it
        return $user->hasAnyRole(['admin', 'root-admin'])
            || $productRent->user_id === $user->id;
    }

    /**
     * Create a product rent.
     * In your scenario, all roles can create, or just 'user' plus Admin?
     */
    public function create(User $user)
    {
        // If you allow normal users to create rental requests:
        return $user->hasRole('user') || $user->hasAnyRole(['admin', 'root-admin']);
    }

    /**
     * Update a product rent.
     */
    public function update(User $user, ProductRent $productRent)
    {
        // Admin, Root Admin, or the user who created it
        return $user->hasAnyRole(['admin', 'root-admin'])
            || $productRent->user_id === $user->id;
    }

    /**
     * Delete a product rent.
     */
    public function delete(User $user, ProductRent $productRent)
    {
        // Admin, Root Admin, or the user who created it
        return $user->hasAnyRole(['admin', 'root-admin'])
            || $productRent->user_id === $user->id;
    }
}
