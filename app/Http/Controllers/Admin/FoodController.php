<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\FoodCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use function Database\Seeders\imageHash;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dishes'] = Food::join('food_categories', 'foods.food_category_id', '=', 'food_categories.id')->select(['foods.*', 'food_categories.id as categoryId', 'food_categories.name as categoryName'])->paginate(10);
        return view('pages.admin.dishes.dishesView', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = FoodCategory::all();
        return view('pages.admin.dishes.createDishForm', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:200',
            'price' => 'required|numeric|min:3|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|exists:food_categories,id',
        ], [
            'name.required' => 'Name is required',
            'name.string' => 'Name must contain only characters',
            'name.max' => 'Name is cannot be longer than 100 characters',
            'description.string' => 'Description must contain only characters',
            'description.max' => 'Description cannot be longer than 200 characters',
            'price.required' => 'Please enter price',
            'price.numeric' => 'Price must be number',
            'price.min' => 'Price must be greater than 3',
            'price.max' => 'Price must be less than 50',
            'image.required' => 'Image is required',
            'image.image' => 'Please upload image',
            'image.mimes' => 'Selected file type is not allowed',
            'image.max' => 'Picture is too large',
            'category.required' => 'Category is required',
            'category.exists' => 'Category must be from offered categories',
        ]);

        $file = $request->file('image');
        $hash = md5_file($file->getRealPath());

        $exists = Food::where('image_hash',$hash)->exists();
        if ($exists) {
            return redirect()->back()->withErrors(['image' => 'Image already exists']);
        }

        $image = time() . '_' .$file->getClientOriginalExtension();
        $file->move(public_path('assets/images'), $image);

        $food = Food::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $image,
            'image_hash' => imageHash($image),
            'food_category_id' => $request->category,
        ]);

        logActivity('New dish added by admin','Dish id : '.$food->id);

        return redirect()->route('dishes.index')->with('success', 'Dish added successfully');
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
        $data['dish'] = Food::join('food_categories', 'foods.food_category_id', '=', 'food_categories.id')->where('foods.id', $id)->select(['foods.*','food_categories.name as categoryName'])->firstOrFail();
        $data['categories'] = FoodCategory::all();
        return view('pages.admin.dishes.editDishForm', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:100,unique:foods,name,'.$id,
            'description' => 'nullable|string|max:200',
            'price' => 'required|numeric|min:3|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|exists:food_categories,id',
        ], [
            'name.required' => 'Name is required',
            'name.string' => 'Name must contain only characters',
            'name.max' => 'Name is cannot be longer than 100 characters',
            'description.string' => 'Description must contain only characters',
            'description.max' => 'Description cannot be longer than 200 characters',
            'price.required' => 'Please enter price',
            'price.numeric' => 'Price must be number',
            'price.min' => 'Price must be greater than 3',
            'price.max' => 'Price must be less than 50',
            'image.required' => 'Image is required',
            'image.image' => 'Please upload image',
            'image.mimes' => 'Selected file type is not allowed',
            'image.max' => 'Picture is too large',
            'category.required' => 'Category is required',
            'category.exists' => 'Category must be from offered categories',
        ]);

        $file = $request->file('image');
        $hash = md5_file($file->getRealPath());

        $exists = Food::where('image_hash',$hash)->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['image' => 'Image already exists']);
        }

        $image = time() . '_' .$file->getClientOriginalExtension();
        $file->move(public_path('assets/images'), $image);
        $dish = Food::findOrFail($id);

        $dish->name = $request->name;
        $dish->description = $request->description;
        $dish->price = $request->price;
        $dish->image = $image;
        $dish->image_hash = $hash;
        $dish->food_category_id = $request->category;
        $dish->save();

        logActivity('Dish edited by admin','Dish id : '.$dish->id);

        return redirect()->route('dishes.index')->with('success', 'Dish updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Food::destroy($id);
        logActivity('Dish deleted by admin','Food id : '.$id);
        return redirect()->route('dishes.index')->with('success', 'Food has been deleted successfully');
    }
}
