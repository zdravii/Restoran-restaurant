<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chef;
use Illuminate\Http\Request;

class ChefController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['chefs'] = Chef::paginate(10);

        if ($request->ajax()) {
            return view('pages.admin.chefs.partials.chefsTable', $data);
        }

        return view('pages.admin.chefs.chefsView', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.chefs.createChefForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:150',
        ],
            [
                'first_name.required' => 'First name is required.',
                'first_name.string' => 'First name must contain only characters.',
                'first_name.max' => 'First name cannot be longer than 100 characters.',
                'last_name.required' => 'Last name is required.',
                'last_name.string' => 'Last name must contain only characters.',
                'last_name.max' => 'Last name cannot be longer than 150 characters.',
            ]);

        $chef = Chef::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        logActivity('New chef added by admin','New chef id : '.$chef->id);

        return redirect()->route('chefs.index')->with('success', 'Chef created successfully.');
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
        $data['chef'] = Chef::find($id);
        return view('pages.admin.chefs.editChefForm', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:150',
        ],
            [
                'first_name.required' => 'First name is required.',
                'first_name.string' => 'First name must contain only characters.',
                'first_name.max' => 'First name cannot be longer than 100 characters.',
                'last_name.required' => 'Last name is required.',
                'last_name.string' => 'Last name must contain only characters.',
                'last_name.max' => 'Last name cannot be longer than 150 characters.',
            ]);

        $chef = Chef::find($id);
        $chef->first_name = $request->first_name;
        $chef->last_name = $request->last_name;
        $chef->save();

        logActivity('Chef edited by admin','Chef id : '.$chef->id);

        return redirect()->route('chefs.index')->with('success', 'Chef updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Chef::destroy($id);
        logActivity('Chef deleted by admin','Chef id : '.$id);
        return redirect()->route('chefs.index')->with('success', 'Chef deleted successfully.');
    }
}
