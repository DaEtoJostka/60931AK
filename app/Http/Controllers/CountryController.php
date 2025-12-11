<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    // List all countries
    public function index()
    {
        $countries = Country::all();
        return view('countries.index', compact('countries'));
    }

    // Show details of one country
    public function show($id)
    {
        // Eager load relationships
        $country = Country::with(['events', 'economies', 'partnersFromFirst', 'partnersFromSecond'])->findOrFail($id);
        
        return view('countries.show', compact('country'));
    }
}
