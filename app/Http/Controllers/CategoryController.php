<?php

namespace App\Http\Controllers;

use App\Events\CategoryDeleteEvent;
use App\Http\Requests\CategoryCreateRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\CategoryTrait;

class CategoryController extends Controller
{
    use CategoryTrait;

    public function allCategories()
    {
        $categories = Category::all();
        $user = auth()->user();
        $user_role = User::ROLE_ADMIN;

        return view('forms.category.categories', ['categories' => $categories, 'user' => $user, 'user_role' => $user_role]);
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


    public function categoryCreate(CategoryCreateRequest $request)
    {
        Category::create($this->getCategoryData($request));

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
            event(new CategoryDeleteEvent($category));

            return redirect(route('categories'))->with('success', 'Category has been successfully deleted!');
        }
        return back()->withErrors( 'The category is not isset');
    }


}
