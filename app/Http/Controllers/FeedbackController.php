<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Feedback;
use Image;

class FeedbackController extends Controller
{
    public function author(Request $request, Feedback $feedback)
    {
        $feedback = Feedback::where('id', $feedback->id)->first();
        return view('author_page', ['feedback' => $feedback]);
    }

    public function edit(Request $request, Feedback $feedback)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'text' => 'required|string|max:255',
             ]);

        $city = City::where('name', $request->city)->first();

        $feedback = Feedback::where('city_id', $city->id)->first();

        $arr = [];

        if($request->file('image'))
        {
            array_push($arr, $request->file('image')->store('city', 'public'));

            $feedback->update([
                'city_id' => $city->id,
                'title' => $request->title,
                'text' => $request->text,
                'rating' => $request->rating,
                'img' => $arr[0],
                'user_id' => \Auth::id(),
            ]);

            return redirect('/myfeedbacks');
        }
        else
        {
            $feedback->update([
                'city_id' => $city->id,
                'title' => $request->title,
                'text' => $request->text,
                'rating' => $request->rating,
                'user_id' => \Auth::id(),
            ]);

            return redirect('/myfeedbacks');
        }
    }

    public function editingPage(Feedback $feedback)
    {
        $cities = City::get();
        return view('edit', ['feedback' => $feedback,
                                'cities' => $cities]);
    }

    public function show()
    {
        $feedbacks = Feedback::where('user_id', \Auth::id())->get();
        return view('myfeedbacks', ['feedbacks' => $feedbacks]);
    }

    public function img(Feedback $feedback)
    {
        $image = Image::make(storage_path('app\public\\' . $feedback->img));
        return $image->response();
    }

    public function store()
    {
        $cities = City::get();
        return view('feedback_create', ['cities' => $cities]);
    }

//ToDo
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'text' => 'required|string|max:255',
             ]);

        $city = City::where('name', $request->city)->first();

        if($request->city && $city)
        {
            $feedback = Feedback::create([
            'city_id' => $city->id,
            'title' => $request->title,
            'text' => $request->text,
            'rating' => $request->rating,
            'img' => $request->file('image')->store('city', 'public'),
            'user_id' => \Auth::id(),
            ]);

            return redirect()->back();
        }
        else
        {
            $data = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=$request->city&appid=fcf55d4417d3c3e2a6b91e233a2945b1&units=metric&lang=ru");
            $data = json_decode($data);
            
            City::create(['name' => $data->name]);

            $city = City::where('name', $data->name)->first();

            $feedback = Feedback::create([
                'city_id' => $city->id,
                'title' => $request->title,
                'text' => $request->text,
                'rating' => $request->rating,
                'img' => $request->file('image')->store('city', 'public'),
                'user_id' => \Auth::id(),
            ]);

            return redirect()->back();
        }
    }
}
