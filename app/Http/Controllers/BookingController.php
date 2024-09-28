<?php

namespace App\Http\Controllers;

use App\Models\ScheduledClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create() {
        $scheduledClasses = ScheduledClass::upcoming()
            ->with('classType', 'instructor')
            ->notBooked()
            ->oldest('date_time')->get();
        return view('member.book', compact('scheduledClasses'));
    }

    public function store(Request $request) {
        /** @var User $user */
        $user = Auth::user();
        $user->bookings()->attach($request->scheduled_class_id);
        return redirect()->route('booking.index')->with('success', 'Class booked successfully');
    }

    public function index() {
        /** @var User $user */
        $user = Auth::user();
        $bookings = $user->bookings()->upcoming()->get();
        return view('member.upcoming', compact('bookings'));
    }

    public function destroy(int $id) {
        /** @var User $user */
        $user = Auth::user();
        $user->bookings()->detach($id);
        return redirect()->route('booking.index')->with('success', 'Class unbooked successfully');
    }
}
