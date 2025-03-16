<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Only Admin or Root Admin can view the product listing.
     */
    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['admin', 'root-admin']);
    }

    /**
     * Only Admin or Root Admin can view a product detail.
     */
    public function view(User $user, Product $product)
    {
        return $user->hasAnyRole(['admin', 'root-admin']);
    }

    /**
     * Only Admin or Root Admin can create a product.
     */
    public function create(User $user)
    {
        return $user->hasAnyRole(['admin', 'root-admin']);
    }

    /**
     * Only Admin or Root Admin can update a product.
     */
    public function update(User $user, Product $product)
    {
        return $user->hasAnyRole(['admin', 'root-admin']);
    }

    /**
     * Only Admin or Root Admin can delete a product.
     */
    public function delete(User $user, Product $product)
    {
        return $user->hasAnyRole(['admin', 'root-admin']);
    }
}
