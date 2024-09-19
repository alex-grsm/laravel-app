<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RealtorListingController extends Controller
{
    public function index(Request $request) {
        // dd(Auth::user()->listings);
        return inertia(
            'Realtor/Index', ['listings' => Auth::user()->listings]
        );
    }

    public function destroy(Listing $listing)
    {
        Gate::authorize('delete', $listing); // Проверка прав на удаление

        $listing->deleteOrFail();

        return redirect()->back()
            ->with('success', 'Listing was deleted!');
    }
}
