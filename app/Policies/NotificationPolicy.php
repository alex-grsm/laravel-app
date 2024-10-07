<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Notifications\DatabaseNotification;

class NotificationPolicy
{
    public function update(User $user, DatabaseNotification $databaseNotification): bool
    {
        dd('I was called');
        return $user->id === $databaseNotification->notifiable_id;
    }
}
