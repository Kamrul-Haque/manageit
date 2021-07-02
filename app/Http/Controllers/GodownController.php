<?php

namespace App\Http\Controllers;

use App\Godown;
use App\Entry;
use App\Product;
use Auth;
use Illuminate\Http\Request;
use DB;

class GodownController extends Controller
{
    public function index()
    {
        $godowns = Godown::orderBy('name')->paginate(10);
        return view('godown.index', compact('godowns'));
    }

    public function create()
    {
        return view('godown.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'location' => 'required',
            'phone' => 'nullable|digits_between:7,10|unique:godowns',
        ]);

        $godown = new Godown;
        $godown->name = $request->input('name');
        $godown->location = $request->input('location');
        $godown->phone = $request->input('phone');
        $godown->save();

        toastr()->success('Created Successfully!');
        return redirect('/godowns');
    }

    public function show(Godown $godown)
    {
        $products = $godown->products()->orderBy('name')->paginate(10);
        $entries = $godown->entries()->paginate(10);

        return view('godown.show', compact('products', 'godown', 'entries'));
    }

    public function edit(Godown $godown)
    {
        return view('godown.edit', compact('godown'));
    }

    public function update(Request $request, Godown $godown)
    {
        $this->validate($request,[
            'name' => 'required',
            'location' => 'required',
            'phone' => 'nullable|digits_between:7,10|unique:godowns,phone,'.$godown->id,
        ]);

        $godown->name = $request->input('name');
        $godown->location = $request->input('location');
        $godown->phone = $request->input('phone');
        $godown->save();

        toastr()->success("Updated Successfully!");
        return redirect('/godowns');
    }

    public function destroy(Godown $godown)
    {
        $godown->delete();

        toastr()->warning("Entry Deleted!");
        return redirect('/godowns');
    }

    /*public function destroyAll()
    {
        $godowns = Godown::all();
        foreach ($godowns as $godown)
        {
            $godown->delete();
        }
        DB::statement('ALTER TABLE godowns AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE entries AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE godown_product AUTO_INCREMENT = 0');

        toastr()->error('All Records Deleted!');
        return redirect('/godowns');
    }*/

    public function restore($godown)
    {
        Godown::onlyTrashed()->find($godown)->restore();

        toastr()->success('Entry Restored!');
        return back();
    }

    public function forceDelete($godown)
    {
        Godown::onlyTrashed()->find($godown)->forceDelete();

        toastr()->error('Entry Permanently Deleted!');
        return back();
    }
}
