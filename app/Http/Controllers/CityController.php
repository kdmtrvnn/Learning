<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Feedback;
use GeoIp2\Database\Reader;

class CityController extends Controller
{
    public function takeYes(Request $request)
    {
        $reader = new Reader(storage_path('GeoLiteCity/GeoLite2-City.mmdb'));
        $record = $reader->city($request->ip());;
        $request->session()->put('city', $record);
        $feedbacks = Feedback::whereHas('city', function($q) use($record){$q->where('name', $record);})->get();
        return view('feedbacks', ['feedbacks' => $feedbacks]);
    }

    public function takeNo(Request $request)
    {
        return redirect('/cities');
    }

     public function welcome(Request $request)
    {
        $reader = new Reader(storage_path('GeoLiteCity/GeoLite2-City.mmdb'));

        if($request->session()->exists('city'))
        {
            $city = $request->session()->get('city');
            $feedbacks = Feedback::whereHas('city', function($q) use($city){$q->where('name', $city);})->get();
            return view('feedbacks', ['feedbacks' => $feedbacks]);
        }

        try 
        {
            $record = $reader->city($request->ip());
            return view('welcome', ['record' => $record]);
        }
        catch(\Exception $e){
            return redirect('/cities');
        }

        return view('welcome');
    }

    public function get(Request $request)
    {
        $cities = City::has('feedbacks')->get();

        if($request->sort == 'desc')
        {
            $cities = City::has('feedbacks')->orderBy('name')->get();
            return view('cities', ['cities' => $cities]);
        }

        return view('cities', ['cities' => $cities]);
    }

     public function take(Request $request, City $city)
    {
        if(!$request->session()->exists('city'))
        {
            $request->session()->put('city', $city->name);
        }

        $feedbacks = Feedback::whereHas('city', function($q) use($city){$q->where('name', $city->name);})->get();

        return view('feedbacks', ['feedbacks' => $feedbacks]);
    }
}
