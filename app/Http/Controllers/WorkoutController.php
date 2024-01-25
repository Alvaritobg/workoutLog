<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workout = Workout::all();
        return view('workout.index', compact('workout'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Workout $workout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workout $workout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workout $workout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workout $workout)
    {
        //
    }
    
    // 
    public function showUserWorkout($userId, $workoutId)
    {
        $userId = 4; 
        $workoutId = 4; 

        $workout = Workout::whereHas('users', function ($query) use ($userId) {
        $query->where('user_id', $userId);
        })
        ->where('id', $workoutId)
        ->first();
    

        return view('workouts.index', compact('workout'));
    }

}
