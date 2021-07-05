<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Feedback;
use GeoIp2\Database\Reader;

class CityController extends Controller
{
    public function get(Request $request)
    {
        /* $reader = new Reader(storage_path('GeoLiteCity/GeoLite2-City.mmdb'));

        try 
        {
            $record = $reader->city($request->ip());
        }
        catch(\Exception $e)
        { */
            if($request->session()->exists('city'))
            {
                $city = $request->session()->get('city');
                $feedbacks = $city->feedbacks()->get();
                return view('feedbacks', ['feedbacks' => $feedbacks]);
            }

            $cities = City::has('feedbacks')->get();

            if($request->sort == 'desc')
            {
                $cities = City::has('feedbacks')->orderBy('name')->get();
                return view('cities', ['cities' => $cities]);
            }
            return view('cities', ['cities' => $cities]);
       // }

       // return view('feedbacks', ['record' => $record]);
    }

     public function take(Request $request, City $city)
    {
        if(!$request->session()->exists('city'))
        {
            $request->session()->put('city', $city);
        }

        $city = $request->session()->get('city');

        $feedbacks = $city->feedbacks()->get();

        return view('feedbacks', ['feedbacks' => $feedbacks]);
    }
}
