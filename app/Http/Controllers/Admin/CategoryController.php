<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\FoodCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['categories'] = FoodCategory::paginate(10);

        if ($request->ajax()) {
            return view('pages.admin.categories.partials.categoriesTable', $data);
        }

        return view('pages.admin.categories.categoriesView',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.categories.createCategoryForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|unique:food_categories',
        ],[
            'name.required' => "Category name is required",
            'name.unique' => "Category already exists",
        ]);

        $category = FoodCategory::create([
           'name' => $request->name,
        ]);

        logActivity('Category created by admin','New category id : '.$category->id);

        return redirect()->route('categories.index')->with('success','Category created successfully');
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
        $data['category'] = FoodCategory::findOrFail($id);
        return view('pages.admin.categories.editCategoryForm',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = FoodCategory::findOrFail($id);
        $request->validate([
           'name' => 'required|unique:food_categories,name,'.$category->name,
        ],[
            'name.required' => "Category name is required",
            'name.unique' => "Category already exists",
        ]);


        $category->name = $request->name;
        $category->save();

        logActivity('Category edited by admin','Category id : '.$category->id);

        return redirect()->route('categories.index')->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        FoodCategory::destroy($id);
        logActivity('Category deleted by admin','Category id : '.$id);
        return redirect()->route('categories.index')->with('success','Category deleted successfully');
    }
}
