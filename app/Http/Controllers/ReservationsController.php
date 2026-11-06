<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index()
    {
        return view('pages.reservation');
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'date' => 'required|date|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
            'person' => 'required|integer|between:2,10',
            'description' => 'nullable|string'
        ],[
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.exists' => 'User does not exist',
            'date.required' => 'Date is required',
            'date.date' => 'Date is invalid',
            'date.date_format' => 'Date is in invalid format',
            'time.required' => 'Time is required',
            'time.date_format' => 'Time is in invalid format',
            'person.required' => 'Number of guests is required',
            'person.integer' => 'Number of guests must be a number',
            'person.in' => 'Number of guests cannot be less than 2,and greater than 10',
            'description.string' => 'Description is must be text',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();
        $from = Carbon::parse($request->date . ' ' . $request->time);
        $to = $from->copy()->addHours(3);
        $reservedTablesId = Reservation::where('date_and_time_start','<',$to)->where('date_and_time_end','>',$from)->where('status','accepted')->pluck('table_id')->toArray();
        $tables = Table::where('seat_number',$request->person)->whereNotIn('id',$reservedTablesId)->get();
        $tableId = $tables->first()?->id;

        if (!$tableId){
            return redirect()->route('reservationMain')->with('error', 'No available tables for entered criteria')->withInput();
        }

        Reservation::create([
            'user_id' => $user->id,
            'table_id' => $tableId,
            'date_and_time_start' => $from,
            'date_and_time_end' => $to,
            'description' => $request->description,
            'status' => 'pending'
        ]);

        return redirect()->route('reservationMain')->with('success', 'Reservation created successfully.');
    }
}
