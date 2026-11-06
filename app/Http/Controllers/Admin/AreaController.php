<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['areas'] = Area::paginate(10);

        if ($request->ajax()) {
            return view('pages.admin.areas.partials.areasTable', $data);
        }

        return view('pages.admin.areas.areasView', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.areas.createAreaForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:areas',
        ],[
            'name.required' => "Area name is required",
            'name.unique' => "Area already exists",
        ]);

        $area = Area::create([
            'name' => $request->name,
        ]);

        logActivity('Area created by admin','New area id : '.$area->id);

        return redirect()->route('areas.index')->with('success', 'Area has been created');
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
        $data['area'] = Area::findOrFail($id);
        return view('pages.admin.areas.editAreaForm', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $area = Area::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:areas,name,'.$area->name,
        ],[
            'name.required' => "Area name is required",
            'name.unique' => "Area already exists",
        ]);

        $area->name = $request->name;
        $area->save();

        logActivity('Area updated by admin','Area id : '.$area->id);

        return redirect()->route('areas.index')->with('success', 'Area has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Area::destroy($id);
        logActivity('Area deleted by admin','Area id : '.$id);
        return redirect()->route('areas.index')->with('success', 'Area has been deleted');
    }
}
