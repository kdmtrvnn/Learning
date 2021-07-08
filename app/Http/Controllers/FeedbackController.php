<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Feedback;
use Image;

class FeedbackController extends Controller
{
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
