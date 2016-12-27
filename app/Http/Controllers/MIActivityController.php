<?php

namespace App\Http\Controllers;

use App\Modal\Activity;
use App\Http\Requests;
use Illuminate\Http\Request;

class MIActivityController extends Controller
{
    public function create(Request $request)
    {
       $this->validate($request, [
         'name'  => 'required',
         'description'  => 'required',
         'options' => 'required',
         ]);
       $activity = new Activity;
        $activity->name = $request->input('name');
        $activity->description = $request->input('description');
        $activity->options = $request->input('options');
        $activity->save();

       return response()->success(compact('activity'));
     }
    public function get()
    {
        $activities = Activity::get();

        return response()
            ->success(compact('activities'));
    }
    public function delete(Request $request)
    {
        $this->validate($request, [
            'id'  => 'required'
        ]);
        $id = $request->input('id');
        return Activity::destroy($id);
    }
    public function getId($id)
    {
        $activity = Activity::find($id);
        return response()->success(compact('activity'));
    }

    public function dayActivities($dayId)
    {
        $activities = Activity::where('day', $dayId)->limit(8)->get();
        $dayName = config('days.' . $dayId);
        return response()->success(compact('activities', 'dayName'));
    }

    public function show($dayId, $id)
    {
        $activities = Activity::where('day', $dayId)->where('activity_number', $id)->first();
        return response()->success(compact('activities'));
    }
}
