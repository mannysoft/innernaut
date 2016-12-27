<?php

namespace App\Http\Controllers;

use App\Modal\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class MIUserController extends Controller
{
    public function index(Request $request)
    {
      $users = User::where('group_id', auth()->user()->group_id)
          ->where('id', '!=', auth()->user()->id)
          ->get();
      return response()->success(compact('users'));
    }
}
