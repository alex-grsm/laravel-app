<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'priceFrom',
            'priceTo',
            'beds',
            'baths',
            'areaFrom',
            'areaTo'
        ]);


        return inertia(
            'Listing/Index',
            [
                'filters' => $filters,
                'listings' => Listing::latest()
                    ->filter($filters)
                    ->paginate(perPage: 9)
                    ->withQueryString()
            ]
        );
    }


    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {

        // if (Auth::user()->cannot('view', $listing)) {
        //     abort(403);
        // }
        $listing->load(['images']);
        $offer = !Auth::user() ? null : $listing->offers()->byMe()->first();

        return inertia(
            'Listing/Show',
            [
                'listing' => $listing,
                'offerMade' => $offer
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Listing $listing)
    // {
    //     Gate::authorize('delete', $listing); // Проверка прав на удаление

    //     $listing->delete();

    //     return redirect()->back()
    //         ->with('success', 'Listing was deleted!');
    // }
}
