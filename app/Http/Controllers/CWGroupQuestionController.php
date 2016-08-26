<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modal\Groupquestion;
use App\Modal\Activity;
use App\Http\Requests;
use DB;

class CWGroupQuestionController extends Controller
{   
    
    public function getId($id)
    {
        $groupquestion = Groupquestion::find($id);

        return response()
        ->success(compact('groupquestion'));
    }

}
