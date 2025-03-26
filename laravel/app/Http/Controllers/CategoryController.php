<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    //
     // Get /api/categories

     public function getCategories()
     {
         return response()->json(Category::all());
     }
 
     // Post /api/categories
     public function createCategory(Request $request)
     {
         $category = Category::create($request->all());
         return response()->json(["message" => "Category created successfully", "category" => $category], 201);
     }
 
     // Get /api/categories/{categoryId}
     public function getCategory($categoryId)
     {
         $category = Category::find($categoryId);
 
         if (!$category) {
             return response()->json(["message" => "Category not found"], 404);
         }
 
         return response()->json($category);
     }
 
     // Patch /api/categories/{categoryId}
     public function updateCategory(Request $request, $categoryId)
     {
         $category = Category::find($categoryId);
 
         if (!$category) {
             return response()->json(["message" => "Category not found"], 404);
         }
 
         $category->update($request->all());
 
         return response()->json(["message" => "Category updated successfully", "category" => $category]);
     }
 
     // Delete /api/categories/{categoryId}
     public function deleteCategory($categoryId)
     {
         $category = Category::find($categoryId);
 
         if (!$category) {
             return response()->json(["message" => "Category not found"], 404);
         }
 
         $category->delete();
 
         return response()->json(["message" => "Category deleted successfully"]);
     }
}