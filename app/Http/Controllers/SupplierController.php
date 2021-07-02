<?php

namespace App\Http\Controllers;

use App\Supplier;
use DB;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderBy('name')->paginate(10);
        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
           'name'=>'required|string|min:4',
           'email'=>'nullable|email|unique:suppliers',
           'phone'=>'required|digits_between:7,10|min:4|unique:suppliers',
           'dues'=>'nullable|numeric|between:-999999999.99,999999999.99',
           'paid'=>'nullable|numeric|between:0,999999999.99',
        ]);

        $supplier = new Supplier;
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->total_due = $request->dues;
        $supplier->total_paid = $request->paid;
        $supplier->save();

        toastr()->success('Created Successfully');
        return redirect('/suppliers');
    }

    public function show(Supplier $supplier)
    {
        return view('supplier.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name'=>'required|string|min:4',
            'email'=>'nullable|email|unique:suppliers,email,'.$supplier->id,
            'phone'=>'required|digits_between:7,10|min:4|unique:suppliers,phone,'.$supplier->id,
            'dues'=>'nullable|numeric|between:-999999999.99,999999999.99',
            'paid'=>'nullable|numeric|between:0,999999999.99',
        ]);

        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->total_due = $request->dues;
        $supplier->total_paid = $request->paid;
        $supplier->save();

        toastr()->info('Updated Successfully');
        return redirect('/suppliers');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        toastr()->warning('Entry Deleted');
        return redirect('/suppliers');
    }

    /*public function destroyAll()
    {
        DB::table('suppliers')->delete();

        toastr()->error('All Records Deleted');
        return redirect('/suppliers');
    }*/

    public function restore($supplier)
    {
        Supplier::onlyTrashed()->find($supplier)->restore();

        toastr()->success('Entry Restored!');
        return back();
    }

    public function forceDelete($supplier)
    {
        Supplier::onlyTrashed()->find($supplier)->forceDelete();

        toastr()->error('Entry Permanently Deleted!');
        return back();
    }
}
