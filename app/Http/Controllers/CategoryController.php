<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function allCategories()
    {
        $categories = Category::all();

        return view('forms.category.categories', ['categories' => $categories]);
    }


    public function categoryCreateForm()
    {
        return view('forms.category.create');
    }


    public function categoryEdit(Request $request)
    {
        $category = Category::find($request->id);

        return view('forms.category.edit', ['category' => $category]);
    }


    public function categoryCreate(Request $request)
    {
        $data = $request->except("_token");
        $category = new Category();
        $category->name = $data['name'];
        $category->save();

        return redirect(route('categories'))->with('success', 'Category has been successfully created!');
    }


    public function categoryUpdate(Request $request)
    {
        $input = $request->except('_token');
        if ($category = Category::find($request->id)){
            $category->update($input);

            return redirect(route('categories'))->with('success', 'Category has been successfully edited!');
        }
        return back()->withErrors( 'The category is not isset');
    }


    public function destroy(Request $request)
    {
        if ($category = Category::find($request->id)){
            $category->delete();

            return redirect(route('categories'))->with('success', 'Category has been successfully deleted!');
        }
        return back()->withErrors( 'The category is not isset');
    }


}
