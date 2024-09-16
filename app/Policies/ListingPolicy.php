<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ListingPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     */
    // public function before(?User $user, $ability)
    // {
    //     if ($user?->is_admin /*&& $ability === 'update'*/) {
    //         return true;
    //     }
    // }

    /**
     * Allow viewing the index (list of listings) for any user, including guests.
     */
    public function viewAny(?User $user): bool
    {
        // Любой пользователь может видеть список
        return true;
    }

    /**
     * Allow viewing individual listings for any user, including guests.
     */
    public function view(?User $user, Listing $listing): bool
    {
        // Любой пользователь может видеть отдельные листинги
        return true;
    }

    /**
     * Allow creating listings only for authenticated users.
     */
    public function create(User $user): bool
    {
        // Только авторизованные пользователи могут создавать листинги
        // return isset($user);
        return false;
        // return true;
    }

    /**
     * Allow updating listings only for the owner of the listing.
     */
    public function update(User $user, Listing $listing): bool
    {
        return $user->id === $listing->by_user_id;
    }

    /**
     * Allow deleting listings only for the owner of the listing.
     */
    public function delete(User $user, Listing $listing): bool
    {
        return $user->id === $listing->by_user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Listing $listing): bool
    {
        return $user->id === $listing->by_user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Listing $listing): bool
    {
        return $user->id === $listing->by_user_id;
    }
}
