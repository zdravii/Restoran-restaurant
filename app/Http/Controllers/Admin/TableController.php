<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['tables'] = Table::join('areas','areas.id','=','tables.area_id')->select('tables.*','areas.name as areaName')->orderBy('tables.id')->paginate(8);

        if ($request->ajax()) {
            return view('pages.admin.tables.partials.tablesTable',$data);
        }

        return view('pages.admin.tables.tablesView', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['areas'] = Area::all();

        return view('pages.admin.tables.createTableForm', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           'number' => 'required|integer|min:1|max:50|unique:tables,number',
            'numberOfSeats' => 'required|integer|min:2|max:8',
            'area' => 'required|in:1,2,3',
        ],[
            'number.required' => 'Number is required',
            'number.integer' => 'Number must be integer',
            'number.min' => 'Number cannot be less than 1',
            'number.max' => 'Number cannot be greater than 50',
            'number.unique' => 'Table already exists',
            'numberOfSeats.required' => 'Number of Seats is required',
            'numberOfSeats.integer' => 'Number of Seats must be integer',
            'numberOfSeats.min' => 'Number of seats cannot be less than 2',
            'numberOfSeats.max' => 'Number of seats cannot be greater than 8',
            'area.required' => 'Area is required',
            'area.in' => 'Area must be form given options',
        ]);

        $table = Table::create([
            'number' => $request->number,
            'seat_number' => $request->numberOfSeats,
            'area_id' => $request->area,
        ]);

        logActivity('New table added by admin','Table id : '.$table->id);

        return redirect()->route('tables.index')->with('success','Table created successfully');
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
        $data['table'] = Table::findOrFail($id);
        $data['areas'] = Area::all();
        return view('pages.admin.tables.editTableForm',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $table = Table::findOrFail($id);
        $request->validate([
            'number' => 'required|integer|min:1|max:50|unique:tables,number,'.$table->number,
            'numberOfSeats' => 'required|integer|min:2|max:8',
            'area' => 'required|in:1,2,3',
        ],[
            'number.required' => 'Number is required',
            'number.integer' => 'Number must be integer',
            'number.min' => 'Number cannot be less than 1',
            'number.max' => 'Number cannot be greater than 50',
            'number.unique' => 'Table already exists',
            'numberOfSeats.required' => 'Number of Seats is required',
            'numberOfSeats.integer' => 'Number of Seats must be integer',
            'numberOfSeats.min' => 'Number of seats cannot be less than 2',
            'numberOfSeats.max' => 'Number of seats cannot be greater than 8',
            'area.required' => 'Area is required',
            'area.in' => 'Area must be form given options',
        ]);


        $table->number = $request->number;
        $table->seat_number = $request->numberOfSeats;
        $table->area_id = $request->area;
        $table->save();

        logActivity('Table added by admin','Table id : '.$table->id);

        return redirect()->route('tables.index')->with('success','Table updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Table::destroy($id);
        logActivity('Table deleted added by admin','Table id : '.$id);
        return redirect()->route('tables.index')->with('success','Table deleted successfully');
    }
}
