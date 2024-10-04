<?php

namespace App\Http\Controllers;

use Inertia\Response;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
/*************  ✨ Codeium Command ⭐  *************/
    /**
     * Get the user's notifications.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
/******  ee28296e-2d58-4e87-bba4-3cf573bda69c  *******/    public function index(Request $request): Response {
        return inertia(
            'Notification/Index',
            [
                'notifications' => $request->user()
                    ->notifications()->paginate(10)
            ]
        );
    }
}
