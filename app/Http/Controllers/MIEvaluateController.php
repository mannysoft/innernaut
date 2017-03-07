<?php

namespace App\Http\Controllers;

use App\Modal\Evaluate;
use App\Modal\Activity;
use App\Http\Requests;
use App\Modal\User;
use Illuminate\Http\Request;
use App\Lib\Chart;
use App\Element;

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
                        'question_type' => 'q33',
                        'group_id' => auth()->user()->group_id,
                        'give_user_id' => $request->input('giver', 1),
                        'take_user_id' => auth()->user()->id,
                        'day' => $activity->day,
                        'activity_id' => $request->id,
                        'question_id' => null,
                        'groupquestion_id' => $i,
                        'measure' => 3
                ]);
                $evaluate->answer = $request->$answer;
                $evaluate->save();

            }
        } elseif ($request->q332) {
            for ($i=1; $i < 10; $i++) { 
                $answer = 'answer' . $i .'a';

                $evaluate = Evaluate::firstOrNew([
                        'question_type' => 'q332',
                        'group_id' => auth()->user()->group_id,
                        'give_user_id' => $request->input('giver', 1),
                        'take_user_id' => auth()->user()->id,
                        'day' => $activity->day,
                        'activity_id' => $request->id,
                        'question_id' => null,
                        'groupquestion_id' => $i,
                        'measure' => 3,
                        'letter' => 'a',
                ]);
                $evaluate->answer = $request->$answer;
                $evaluate->save();

                $answer = 'answer' . $i .'b';
                $evaluate = Evaluate::firstOrNew([
                        'question_type' => 'q332',
                        'group_id' => auth()->user()->group_id,
                        'give_user_id' => $request->input('giver', 1),
                        'take_user_id' => auth()->user()->id,
                        'day' => $activity->day,
                        'activity_id' => $request->id,
                        'question_id' => null,
                        'groupquestion_id' => $i,
                        'measure' => 3,
                        'letter' => 'b',
                ]);
                $evaluate->answer = $request->$answer;
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

                $groupquestionid = $request->input('groupquestion_id');
                if ($groupquestionid == 0) {
                    $groupquestionid = 1;
                }
                $evaluate = Evaluate::firstOrNew([
                    'question_type' => 'groupscan',
                    'group_id' => auth()->user()->group_id,
                    'give_user_id' => $request->input('giver', 1),
                    'take_user_id' => auth()->user()->id,
                    'day' => $activity->day,
                    'activity_id' => $request->id,
                    'question_id' => null,
                    'groupquestion_id' => $groupquestionid,
                    'measure' => 3,
                    'letter' => 'a',
                    'group_user_id' => $user->id,
                ]);
                $evaluate->answer = $answersa[$i];
                $evaluate->save();

                $evaluate = Evaluate::firstOrNew([
                    'question_type' => 'groupscan',
                    'group_id' => auth()->user()->group_id,
                    'give_user_id' => $request->input('giver', 1),
                    'take_user_id' => auth()->user()->id,
                    'day' => $activity->day,
                    'activity_id' => $request->id,
                    'question_id' => null,
                    'groupquestion_id' => $groupquestionid,
                    'measure' => 3,
                    'letter' => 'b',
                    'group_user_id' => $user->id,
                ]);
                $evaluate->answer = $answersb[$i];
                $evaluate->save();
                $i ++;
            }
        } else {

            $evaluate = Evaluate::firstOrNew([
                    'question_type' => 'single',
                    'group_id' => auth()->user()->group_id,
                    'give_user_id' => $request->input('giver', 1),
                    'take_user_id' => auth()->user()->id,
                    'day' => $activity->day,
                    'activity_id' => $request->id,
                    'question_id' => $request->input('id'),
                    'groupquestion_id' => $request->input('groupquestion_id'),
                    'measure' => 3,
            ]);
            $evaluate->answer = $request->input('answer');
            $evaluate->save();
        }

        $chart = new Chart;

        $questions = [1, 2, 3, 4, 5, 6, 7, 8, 9];

        foreach ($questions as $q) {
            // $data = array(30, 35, 40, 55, 75, 100);
            // # The labels for the line chart
            // $labels = array(17, "18", "19", "20", "30", "50");

            $data = [];
            
            //$data[] = $this->getData($activity, $request, 'single', $q);
            $data[] = $this->getData($activity, $request, 'q33', $q);
            $data[] = $this->getData($activity, $request, 'q332', $q);
            $data[] = $this->getData($activity, $request, 'groupscan', $q);

            

            //$data = array(30, 35, 40);
            # The labels for the line chart
            $labels = array("3x3", "3x3x2", "Group Scan");
            
            // Can generate more charts (8) charts
            $chart->lineChart($data, $labels, auth()->user()->id, $activityId = $request->id, $q);
        }

        return response()->success(compact('evaluate'));
    }

    public function getData($activity, $request, $questionType, $q)
    {
        $evaluates = Evaluate::where('day', $activity->day)
                ->where('question_type', $questionType)
                ->where('groupquestion_id', '>=', 1)
                ->where('activity_id', $request->id)
                ->get();

        $c = [];
        foreach ($evaluates as $e) {
            if (@$c[$e->groupquestion_id]) {
                $c[$e->groupquestion_id] += $e->answer;
            } else {
                $c[$e->groupquestion_id] = $e->answer;
            }
        }

        if (@$c[$q]) {
            return $c[$q];
        }
        return 0;
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

    public function analyze($activityId)
    {
       // $elements = Evaluate::where('take_user_id', auth()->user()->id)
       //      ->where('activity_id', $activityId)
       //      ->get();

       //  return response()->success(compact('elements'));
        $elements = [];
        foreach (config('items') as $key => $val) {
            $elements[] = [
                'activity_id' => $activityId,
                'id' => $key,
                'title' => $val,
                'description' => $val,
                'path' => 'img/charts/' . auth()->user()->id . '/' . $activityId . '/' .$key . '.png?hash' . md5(time()),
            ];
        }

        //$elements = Element::get();

        return response()->success(compact('elements'));
    }
}
