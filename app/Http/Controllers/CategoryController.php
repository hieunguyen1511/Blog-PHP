<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAll(){
        $categories = Category::all();
        return response()->json([
            'status' => '200',
            'categories' => $categories
        ]
        );
    }

    public function get($id){
        $category = Category::find($id);
        return response()->json([
            'status' => '200',
            'category' => $category
        ]
        );
    }

    public function create(Request $request){
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'status' => '200',
            'message' => 'Category created successfully'
        ]
        );
    }

    public function update(Request $request){
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'status' => '200',
            'message' => 'Category updated successfully'
        ]
        );
    }
    public function delete(Request $request){
        $category = Category::find($request->id);
        $category->delete();
        return response()->json([
            'status' => '200',
            'message' => 'Category deleted successfully'
        ]
        );
    }




}
