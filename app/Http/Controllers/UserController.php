<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Participer;
use App\Models\Team;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $activity = Activity::findOrFail($id);
        return view('joinActivity', ['activity' => $activity]);
    }

    public function showUserActivities()
    {
        $userActivities = [];
        $activities_id = Participer::where('user_id' , auth()->user()->id)->get('activity_id')
        ;
        foreach($activities_id as $activity_id){
            $activity = Activity::find($activity_id)->first();
            array_push($userActivities , $activity);
        };
        return view('/activities' , ['userActivities' => $userActivities]);
    }

    public function joinActivity(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $id = auth()->user()->id;
        try {
            $fields = $request->validate([
                'team' => 'required',
                'participant_id' => 'required',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('message: please fill the fields');
        }
        if ($fields['team'] != 'individual') {
            $team = Team::where('name', $fields['team'])->whereHAs('users', function ($query) use ($id) {
                $query->where('users.id', $id);
            });
            $participants = $team->users;
            foreach($participants as $participant){
                $participant->activities()->attach($activity->id , ['participater_number' => $fields['participant_id']]);
                $activity->participants++;
                $activity->save();
            }
        }
        if($fields['team'] === 'individual')
        {
            $participant = User::findORFail(auth()->user()->id);
            $check = Participer::where('activity_id' , $activity->id)->where('user_id' , $participant->id)->first();
            if($check)
            {
                return redirect()->back()->with('error','you already registered in this activity');
            }
            $participant->activities()->attach($activity->id , ['participater_number' => $fields['participant_id']]);
            $activity->participants++;
            $activity->save();
        }


        $userActivities = [];
        $activities_id = Participer::where('user_id' , auth()->user()->id)->get('activity_id')
        ;
        foreach($activities_id as $activity_id){
            $activity = Activity::find($activity_id)->first();
            array_push($userActivities , $activity);
        };
        return view('/activities' , ['userActivities' => $userActivities]);        return view('/activities' , ['userActivities' => $userActivities]);

    }
}
