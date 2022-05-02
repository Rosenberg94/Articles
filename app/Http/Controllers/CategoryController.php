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
//        dd('cat');
        $category_id = $request->id;
        $category = Category::find($category_id);

        return view('forms.category.edit', ['category' => $category]);
    }

    public function categoryCreate(Request $request)
    {
        $data = $request->except("_token");
        $category = new Category();
        $category->name = $data['name'];
        $category->save();

        return redirect(route('categories'));
    }

    public function categoryUpdate(Request $request)
    {
        $category = Category::find($request->id);
        $input = $request->except('_token');
        if ($category){
            if($this->__authUserCheck($category)) {
                $category->update($input);

                return redirect(route('categories'))->with('success', 'Category has been successfully edited!');
            } else {

                return back()->withErrors('You have no access for this action or category is not exist');
            }
        }

        return back()->withErrors( 'The category is not isset');
    }

    public function destroy(Request $request)
    {
        $category_id = $request->id;
        $category = Category::find($category_id);
        if ($category){
            if($this->__authUserCheck($category)) {
                $category->delete();

                return redirect(route('categories'))->with('success', 'Category has been successfully deleted!');
            } else {
                return back()->withErrors('You have no access for this action or category is not exist');
            }
        }
        return back()->withErrors( 'The category is not isset');
    }

    private function __authUserCheck($category)
    {
        $user = auth()->user();

        return $user->role_id == User::ROLE_ADMIN;
    }
}
