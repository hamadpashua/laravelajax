<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountriesController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('countries-list');
    }
    public function addCountry(Request $request)
    {
        $validator = Validator::make($request->all(),[
                'country_name' => 'required|unique:countries',
                'capital_city' => 'required',
            ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $country = Country::create([
                'country_name' => $request->country_name,
                'capital_city' => $request->capital_city
            ]
            );
            // $country = new Country();
            // $country->country_name = $request->country_name;
            // $country->capital_city = $request->capital_city;
            // $query = $country->save();
            if (!$country) {
                return response()->json(['code' => 0, 'msg' => 'Something Went Wrong!']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'New Country created Successfully']);
            }
            
        }
        
    }
}
