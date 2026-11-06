<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\FoodCategory;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    public function index(Request $request)
    {

        $data['categories'] = FoodCategory::all();
        $query = Food::query();

        if($request->categoryFilter)
        {
            $query->where('food_category_id', $request->categoryFilter);
        }
        if($request->minPrice){
            $query->where('price', '>=', $request->minPrice);
        }
        if($request->maxPrice){
            $query->where('price', '<=', $request->maxPrice);
        }

        $data['foods'] = $query->paginate(8)->appends($request->query());

        if ($request->ajax()) {
            return view('partials.menuProducts',$data);
        }

        return view('pages.menu', $data);
    }
}
