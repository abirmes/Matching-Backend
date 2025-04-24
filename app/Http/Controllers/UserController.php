<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $activity = Activity::findOrFail($id);
        return view('joinActivity' , ['activity' => $activity]);
    }

    public function joinActivity(Request $request)
    {
        return view('/activityCreate');
    }

    
}
