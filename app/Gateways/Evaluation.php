<?php

namespace App\Gateways;

use App\Modal\Evaluate;
use App\Modal\Activity;
use App\Http\Requests;
use App\Modal\User;
use Illuminate\Http\Request;

class Evaluation
{
    public function evaluate($request)
    {
        $activity = Activity::find($request->id);

        if ($request->q33) {
            for ($i=1; $i < 10; $i++) { 
                $answer = 'answer' . $i;
                $evaluate = new Evaluate;
                $evaluate->group_id = auth()->user()->group_id;
                $evaluate->give_user_id = $request->input('giver', 1);
                $evaluate->take_user_id = auth()->user()->id;
                $evaluate->day = $activity->day;
                $evaluate->activity_id = $request->id;
                $evaluate->question_id = null;
                $evaluate->groupquestion_id = $i;
                $evaluate->measure = 3;
                $evaluate->answer = $request->$answer;
                $evaluate->save();
            }
        } elseif ($request->q332) {
            for ($i=1; $i < 10; $i++) { 
                $answer = 'answer' . $i .'a';
                $evaluate = new Evaluate;
                $evaluate->group_id = auth()->user()->group_id;
                $evaluate->give_user_id = $request->input('giver', 1);
                $evaluate->take_user_id = auth()->user()->id;
                $evaluate->day = $activity->day;
                $evaluate->activity_id = $request->id;
                $evaluate->question_id = null;
                $evaluate->groupquestion_id = $i;
                $evaluate->measure = 3;
                $evaluate->answer = $request->$answer;
                $evaluate->letter = 'a';
                $evaluate->save();

                $answer = 'answer' . $i .'b';
                $evaluate = new Evaluate;
                $evaluate->group_id = auth()->user()->group_id;
                $evaluate->give_user_id = $request->input('giver', 1);
                $evaluate->take_user_id = auth()->user()->id;
                $evaluate->day = $activity->day;
                $evaluate->activity_id = $request->id;
                $evaluate->question_id = null;
                $evaluate->groupquestion_id = $i;
                $evaluate->measure = 3;
                $evaluate->answer = $request->$answer;
                $evaluate->letter = 'b';
                $evaluate->save();
            }
        } elseif ($request->groupscan) {
            
            // We need to get all the users with in the group
            $users = User::where('group_id', auth()->user()->group_id)
              ->where('id', '!=', auth()->user()->id)
              ->get();

            $answersa = $request->useranswera;
            $answersb = $request->useranswerb;

            $i = 0;
            foreach ($users as $user) {
                $evaluate = new Evaluate;
                $evaluate->group_id = auth()->user()->group_id;
                $evaluate->give_user_id = $request->input('giver', 1);
                $evaluate->take_user_id = auth()->user()->id;
                $evaluate->day = $activity->day;
                $evaluate->activity_id = $request->id;
                $evaluate->question_id = null;
                $evaluate->groupquestion_id = $request->groupquestion_id;
                $evaluate->measure = 3;
                $evaluate->answer = $answersa[$i];
                $evaluate->letter = 'a';
                $evaluate->group_user_id = $user->id;
                $evaluate->save();

                $evaluate = new Evaluate;
                $evaluate->group_id = auth()->user()->group_id;
                $evaluate->give_user_id = $request->input('giver', 1);
                $evaluate->take_user_id = auth()->user()->id;
                $evaluate->day = $activity->day;
                $evaluate->activity_id = $request->id;
                $evaluate->question_id = null;
                $evaluate->groupquestion_id = $request->groupquestion_id;
                $evaluate->measure = 3;
                $evaluate->answer = $answersb[$i];
                $evaluate->letter = 'b';
                $evaluate->group_user_id = $user->id;
                $evaluate->save();
                $i ++;
            }
        } else {
            $evaluate = new Evaluate;
            $evaluate->group_id = auth()->user()->group_id;
            $evaluate->give_user_id = $request->input('giver', 1);
            $evaluate->take_user_id = auth()->user()->id;
            $evaluate->day = $activity->day;
            $evaluate->activity_id = $request->id;
            $evaluate->question_id = $request->input('id');
            $evaluate->groupquestion_id = $request->input('groupquestion_id');
            $evaluate->measure = 3;
            $evaluate->answer = $request->input('answer');
            $evaluate->save();
        }

        return $evaluate;
    }
}
