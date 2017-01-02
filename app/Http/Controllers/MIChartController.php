<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Element;
use App\Http\Requests;
use DB;
use App\Lib\Chart;

class MIChartController extends Controller
{   
    public function create(Request $request)
    {
       $this->validate($request, [
         'titre'  => 'required',
         'description' => 'required',
         'lieu' => 'required',
         'photo' => 'required',
       ]);
        
       $post = new Element;
       $post->titre = $request->input('titre');
       $post->description = $request->input('description');
       $post->lieu = $request->input('lieu');
       $post->photo = $request->input('photo');
       
       $post->save();

       return response()->success(compact('element'));
    }

    public function index()
    {
      $chart = new Chart;
      return $chart->pieChat();
    }

    public function scatter()
    {
      $chart = new Chart;
      $chart->scatter();
    }
}
