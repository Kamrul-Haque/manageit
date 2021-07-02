<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')->paginate(10);
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:4',
            'size' => 'required',
            'color' => 'required|string|min:4',
            'image' => 'nullable|file|mimes:png,jpg,jpeg|max:128',
        ]);

        $category = Category::find($request->category);

        $product = new Product;
        $product->sl_no = $category->name.'-'.$request->name.'-'.time();
        $product->name = $request->name;
        $product->category_id = $category->id;
        $product->size = $request->size;
        $product->color = $request->color;

        if ($request->hasFile('image'))
        {
            $path = $request->file('image')->store('ProductImages');
            $product->image = $path;
        }

        $product->save();

        toastr()->success('Created Successfully!');
        return redirect('/products');
    }

    public function show(Product $product)
    {
        return view('product.show',compact('product'));
    }

    public function salesIndex()
    {
        $products = Product::with('invoiceProducts.invoice.client')->orderBy('name')->paginate(10);
        return view('product.sales', compact('products'));
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required|string|min:4',
            'size' => 'required',
            'color' => 'required|string|min:4',
            'image' => 'nullable|file|mimes:png,jpg,jpeg|max:128',
        ]);

        $product->name = $request->name;
        $product->size = $request->size;
        $product->color = $request->color;
        $oldImage = $product->getOriginal('image');

        if ($request->hasFile('image'))
        {
            if (File::exists($oldImage))
            {
                File::delete($oldImage);
            }
            $path = $request->file('image')->store('ProductImages');
            $product->image = $path;
        }

        $product->save();

        toastr()->success("Updated Successfully!");
        return redirect('/products');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        toastr()->warning('Entry Deleted!');
        return redirect('/products');
    }

    /*public function destroyAll()
    {
        $products = Product::all();
        foreach ($products as $product)
        {
            $product->delete();
        }
        DB::statement('ALTER TABLE products AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE entries AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE godown_product AUTO_INCREMENT = 0');

        toastr()->error('All Records Deleted!');
        return redirect('/admin/products');
    }*/

    public function restore($product)
    {
        Product::onlyTrashed()->find($product)->restore();

        toastr()->success('Entry Restored!');
        return back();
    }

    public function forceDelete($product)
    {
        Product::onlyTrashed()->find($product)->forceDelete();

        toastr()->error('Entry Permanently Deleted!');
        return back();
    }
}
