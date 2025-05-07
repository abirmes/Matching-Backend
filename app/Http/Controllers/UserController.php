<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Activity;
use App\Models\Categorie;
use App\Models\Participer;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('/admin/users' , ['users' => $users]);
    }

    public function store(Request $request)
    {
        return 'this is store';
    }
    public function update(Request $request)
    {
        return 'this is update';
    }
    public function delete(Request $request)
    {
        return 'this is delete';
    }

    public function updateUserRole(Request $request){
        $user = User::findOrFail($request->id);
        try {
            $fields = $request->validate([
                'role' => 'required',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' , 'you should select a role ']);
        }

        
        $role = Role::where('name' , $fields['role'])->first();
        $user->role()->associate($role->id);
        $user->save();
        
        return redirect()->back()->with('success' , 'role changed successfully');
    }

    public function updateUserStatus(Request $request){
        $user = User::findOrFail($request->id);
        try {
            $fields = $request->validate([
                'status' => 'required',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' , 'you should select a role ']);
        }

        
        
        $user->status = StatusEnum::from($fields['status']);
        $user->save();
        
        return redirect()->back()->with('success' , 'status changed successfully');
    }
    
    public function updateUserMerite(Request $request){
        // dd($request->all());
        $user = User::findOrFail($request->id);
        try {
            $fields = $request->validate([
                'merite' => 'required|numeric|lt:101',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' , 'you should select a valide merite ']);
        }

        
        
        $user->merite = $fields['merite'];
        if($user->merite < 70){
            $user->status = StatusEnum::from('inactive');
        }
        if($user->merite < 20){
            $user->status = StatusEnum::from('banned');
        }
        if($user->merite >69){
            $user->status = StatusEnum::from('active');
        }
        $user->save();
        
        return redirect()->back()->with('success' , 'merite changed successfully');
    }
    public function updateUserAdresse(Request $request){
        return 'this is adresse update';
    }

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
        $participant = User::findORFail(auth()->user()->id);
        if($participant->status === 'banned'){
            return redirect()->back()->with('error' ,'you are banned from any activity for a while ');
        }
        if($activity->participants === $activity->max_participants){
            return redirect()->back()->with('error' ,'this activity has reached it limits participants ');
        }
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


    public function statistics(){
        $users = User::count();
        $atcivities = Activity::count();
        $categories = Categorie::count();
        $participations = Participer::count();

        return view(
            '/admin/dashboard' , ['users' => $users,
            'atcivities' => $atcivities,
            'categories' => $categories,
            'participations' => $participations]
        );
    }
}
