<?php

namespace App\Http\Controllers;

use App\Modal\Evaluate;
use App\Modal\Activity;
use App\Http\Requests;
use App\Modal\User;
use Illuminate\Http\Request;

class MIEvaluateController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            //'giver'  => 'required',
            //'taker' => 'required',
            //'day' => 'required',
            //'answer' => 'required',
       ]);

        // We dont save its already exists

        $activity = Activity::find($request->id);

        if ($request->q33) {
            for ($i=1; $i < 10; $i++) { 
                $answer = 'answer' . $i;
                
                $evaluate = Evaluate::firstOrNew([
                        'group_id' => auth()->user()->group_id,
                        'give_user_id' => $request->input('giver', 1),
                        'take_user_id' => auth()->user()->id,
                        'day' => $activity->day,
                        'activity_id' => $request->id,
                        'question_id' => null,
                        'groupquestion_id' => $i,
                        'measure' => 3,
                        'answer' => $request->$answer
                ]);

                $evaluate->save();

            }
        } elseif ($request->q332) {
            for ($i=1; $i < 10; $i++) { 
                $answer = 'answer' . $i .'a';

                $evaluate = Evaluate::firstOrNew([
                        'group_id' => auth()->user()->group_id,
                        'give_user_id' => $request->input('giver', 1),
                        'take_user_id' => auth()->user()->id,
                        'day' => $activity->day,
                        'activity_id' => $request->id,
                        'question_id' => null,
                        'groupquestion_id' => $i,
                        'measure' => 3,
                        'answer' => $request->$answer,
                        'letter' => 'a',
                ]);

                $evaluate->save();

                $answer = 'answer' . $i .'b';
                $evaluate = Evaluate::firstOrNew([
                        'group_id' => auth()->user()->group_id,
                        'give_user_id' => $request->input('giver', 1),
                        'take_user_id' => auth()->user()->id,
                        'day' => $activity->day,
                        'activity_id' => $request->id,
                        'question_id' => null,
                        'groupquestion_id' => $i,
                        'measure' => 3,
                        'answer' => $request->$answer,
                        'letter' => 'b',
                ]);
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

                $evaluate = Evaluate::firstOrNew([
                    'group_id' => auth()->user()->group_id,
                    'give_user_id' => $request->input('giver', 1),
                    'take_user_id' => auth()->user()->id,
                    'day' => $activity->day,
                    'activity_id' => $request->id,
                    'question_id' => null,
                    'groupquestion_id' => $request->groupquestion_id,
                    'measure' => 3,
                    'answer' => $answersa[$i],
                    'letter' => 'a',
                    'group_user_id' => $user->id,
                ]);
                $evaluate->save();

                $evaluate = Evaluate::firstOrNew([
                    'group_id' => auth()->user()->group_id,
                    'give_user_id' => $request->input('giver', 1),
                    'take_user_id' => auth()->user()->id,
                    'day' => $activity->day,
                    'activity_id' => $request->id,
                    'question_id' => null,
                    'groupquestion_id' => $request->groupquestion_id,
                    'measure' => 3,
                    'answer' => $answersb[$i],
                    'letter' => 'b',
                    'group_user_id' => $user->id,
                ]);
                $evaluate->save();
                $i ++;
            }
        } else {

            $evaluate = Evaluate::firstOrNew([
                    'group_id' => auth()->user()->group_id,
                    'give_user_id' => $request->input('giver', 1),
                    'take_user_id' => auth()->user()->id,
                    'day' => $activity->day,
                    'activity_id' => $request->id,
                    'question_id' => $request->input('id'),
                    'groupquestion_id' => $request->input('groupquestion_id'),
                    'measure' => 3,
                    'answer' => $request->input('answer'),
            ]);
            $evaluate->save();
        }

       return response()->success(compact('evaluate'));
     }

    public function show($id)
    {
        $evaluates = Evaluate::find(1);

        return response()
            ->success(compact('evaluates'));
    }

    public function get()
    {
        $evaluates = Evaluate::get();

        return response()
            ->success(compact('evaluates'));
    }
}
