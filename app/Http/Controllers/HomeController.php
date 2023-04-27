<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Region;
use App\Models\Venue;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return inertia('Home', [
            'venueCount' => Venue::count(),
            'regionCount' => Region::count(),
            'areaCount' => Area::count()
        ]);
    }
}
