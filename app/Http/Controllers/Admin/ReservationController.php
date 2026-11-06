<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['reservations'] = Reservation::join('users', 'reservations.user_id', '=', 'users.id')->join('tables', 'reservations.table_id', '=', 'tables.id')->select('reservations.id', 'users.email AS user', 'tables.number as tableNumber', 'reservations.date_and_time_start','date_and_time_end', 'reservations.description', 'reservations.status')->paginate(10);

        if ($request->ajax()) {
            return view('pages.admin.users.partials.usersTable', $data);
        }

        return view('pages.admin.reservations.reservationsView', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['tables'] = Table::select('id', 'number')->get();
        $data['statuses'] = ['accepted', 'rejected', 'pending'];
        return view('pages.admin.reservations.createReservation', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $emails = User::pluck('email');
        $tables = Table::pluck('id');
        $request->validate([
            'email' => ['required', 'email', Rule::in($emails)],
            'table' => [Rule::in($tables)],
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'status' => 'in:accepted,rejected,pending'
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Email is invalid.',
            'email.in' => 'User does not exist.',
            'table.in' => 'Table is required',
            'date.required' => 'Date is required.',
            'date.date' => 'Date is invalid.',
            'date.after_or_equal' => 'Date cannot be in past.',
            'time.required' => 'Time is required.',
            'time.date_format' => 'Time is invalid.',
            'status.in' => 'Status is required.'
        ]);

        $user = User::where('email', $request->email)->first();
        $table = Table::where('number', $request->table)->first();

        $from = Carbon::parse($request->date . ' ' . $request->time);
        $to = $from->copy()->addHours(3);


        if (Reservation::where('table_id', $table->id)->whereBetween('date_and_time', [$from, $to])->exists()) {
            return redirect()->back()->with('error', 'Reservation for selected table,date and time already exists.')->withInput();
        } else {
            $reservation = Reservation::create([
                'user_id' => $user->id,
                'table_id' => $table->id,
                'date_and_time_start' => $from,
                'date_and_time_end' => $to,
                'description' => $request->description,
                'status' => $request->status
            ]);

            logActivity('New reservation created by admin','Reservation id : '.$reservation->id);

            return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $data['reservation'] = $reservation;
        $data['tables'] = Table::select('id', 'number')->get();
        $data['table'] = Table::where('id', $reservation->table_id)->get();
        $data['email'] = User::where('id', $reservation->user_id)->value('email');
        $data['statuses'] = ['accepted', 'rejected', 'pending'];
        return view('pages.admin.reservations.editReservationForm', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $emails = User::pluck('email');
        $tables = Table::pluck('id');
        $request->validate([
            'email' => ['required','email',Rule::in($emails)],
            'table' => ['required',Rule::in($tables)],
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'status' => 'in:accepted,rejected,pending'
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Email is invalid.',
            'email.in' => 'User does not exist.',
            'table.required' => 'Table is required',
            'table.in' => 'Table does not exist',
            'date.required' => 'Date is required.',
            'date.date' => 'Date is invalid.',
            'date.after_or_equal' => 'Date cannot be in past.',
            'time.required' => 'Time is required.',
            'time.date_format' => 'Time is invalid.',
            'status.in' => 'Status is required.'
        ]);

        $reservation = Reservation::findOrFail($id);
        $user = User::where('email', $request->email)->firstOrFail();
        $reservation->update([
            'user_id' => $user->id,
            'table_id' => $reservation->table_id,
            'date_and_time_start' => Carbon::parse($request->date . ' ' . $request->time),
            'date_and_time_end' => Carbon::parse($request->date . ' ' . $request->time)->addHours(3),
            'description' => $request->description,
            'status' => $request->status
        ]);

        logActivity('Reservation edited by admin','Reservation id : '.$reservation->id);

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        logActivity('Reservation deleted by admin','Reservation id : '.$reservation->id);
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully');
    }
}
