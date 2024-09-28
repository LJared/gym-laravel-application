<?php

namespace App\Http\Controllers;

use App\Models\ClassType;
use Illuminate\Http\Request;
use App\Models\ScheduledClass;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ScheduledClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        /** @var User $user */
        $user = Auth::user();
        $scheduledClasses = $user->scheduledClasses()
            ->upcoming()
            ->oldest('date_time')
            ->get();
        return view('instructor.upcoming')->with('scheduledClasses', $scheduledClasses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classTypes = ClassType::all();
        return view('instructor.schedule')->with('classTypes', $classTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date_time = $request->date . ' ' . $request->time;
        /** @var User $user */
        $user = Auth::user();
        $request->merge([
            'date_time' => $date_time,
            'instructor_id' => $user->id
        ]);
        $validated = $request->validate([
            'class_type_id' => 'required',
            'instructor_id' => 'required',
            'date_time' => 'required|unique:scheduled_classes,date_time|after:now',
        ]);
        ScheduledClass::create($validated);
        return redirect()->route('schedule.index')->with('success', 'Class scheduled successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ScheduledClass $scheduledClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ScheduledClass $scheduledClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ScheduledClass $scheduledClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScheduledClass $schedule)
    {
        /** @var User $user */
        $user = Auth::user();
        if($user->cannot('delete', $schedule)) {
            abort(403);
        }

        $schedule->delete();
        return redirect()->route('schedule.index')->with('success', 'Class deleted successfully');
    }
}
