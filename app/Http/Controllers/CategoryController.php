<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->paginate(18);
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|min:4|unique:categories',
            'image'=>'nullable|file|mimes:png,jpg,jpeg|max:128'
        ]);

        $category = new Category();
        $category->name = $request->name;

        if ($request->hasFile('image'))
        {
            $path = $request->file('image')->store('Categories');
            $category->image = $path;
        }

        $category->save();

        toastr()->success('Category Created Successfully!');
        return redirect('/category');
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=>'required|string|min:4|unique:categories,name,'.$category->id,
            'image'=>'nullable|file|mimes:png,jpg,jpeg|max:128'
        ]);

        $category->name = $request->name;
        $oldimage = $category->getOriginal('image');

        if ($request->hasFile('image'))
        {
            if (File::exists($oldimage))
            {
                File::delete($oldimage);
            }

            $path = $request->file('image')->store('Categories');
            $category->image = $path;
        }

        $category->save();

        toastr()->info('Category Updated Successfully!');
        return redirect('/category');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        toastr()->warning('Category Deleted!');
        return redirect('/category');
    }

    public function restore($category)
    {
        Category::onlyTrashed()->find($category)->restore();

        toastr()->success('Category Restored!');
        return back();
    }

    public function forceDelete($category)
    {
        Category::onlyTrashed()->find($category)->forceDelete();

        toastr()->error('Category Permanently Deleted!');
        return back();
    }
}
