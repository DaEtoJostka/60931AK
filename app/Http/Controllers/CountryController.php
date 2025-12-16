<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    public function index()
    {
        $countries = Country::all();
        return view('countries.index', compact('countries'));
    }


    public function show($id)
    {

        $country = Country::with(['events', 'economies', 'partnersFromFirst', 'partnersFromSecond'])->findOrFail($id);
        
        return view('countries.show', compact('country'));
    }
}
