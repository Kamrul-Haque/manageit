<?php

namespace App\Http\Controllers;

use App\CashRegister;
use App\Supplier;
use App\SupplierPayment;
use Auth;
use Illuminate\Http\Request;

class SupplierPaymentController extends Controller
{
    public function index()
    {
        $supplierPayments = SupplierPayment::latest()->paginate(10);
        return view('supplier-payment.index', compact('supplierPayments'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('name')->get();
        return view('supplier-payment.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier'=>'required',
            /*'type'=>'required',
            'cheque_no'=>'nullable|required_if:type,Cheque',
            'card'=>'nullable|required_if:type,Card',
            'validity'=>'nullable|required_if:type,Card',
            'cvv'=>'nullable|required_if:type,Card',*/
            'amount'=>'required|numeric|gt:0',
            'date'=>'required|before_or_equal:today',
        ]);

        $supplierPayment = new SupplierPayment;
        $supplierPayment->supplier_id = $request->supplier;
        /*$supplierPayment->type = $request->type;*/

        if ($request->type == 'Cheque')
        {
            $supplierPayment->cheque_no = $request->cheque_no;
            $supplierPayment->status = 'Pending';
        }
        else if ($request->type == 'Card')
        {
            $supplierPayment->card_no = $request->card;
            $supplierPayment->validity = $request->validity;
            $supplierPayment->cvv = $request->cvv;
            $supplierPayment->supplier->total_due -= $request->amount;
        }
        else
            $supplierPayment->supplier->total_due -= $request->amount;

        $supplierPayment->amount = $request->amount;
        $supplierPayment->date_of_issue = $request->date;
        $supplierPayment->received_by = Auth::user()->name;
        $supplierPayment->push();
        $this->saveWithdraw($request->amount, $request->date);

        toastr()->success('Created Successfully');
        return redirect('/supplier-payment');
    }

    public function saveWithdraw($amount, $date)
    {
        $cash = new CashRegister;
        $cash->type = "Withdraw";
        $cash->amount = $amount;
        $cash->title = "Supplier Payment";
        $cash->date = $date;
        $cash->save();
    }

    public function show(SupplierPayment $supplierPayment)
    {;
        return view('supplier-payment.show', compact('supplierPayment'));
    }

    public function edit(SupplierPayment $supplierPayment)
    {
        return view('supplier-payment.edit', compact('supplierPayment'));
    }

    public function update(Request $request, SupplierPayment $supplierPayment)
    {
        $request->validate([
            'status'=>'required',
            'date'=>'nullable|required_if:status,Drawn|before_or_equal:today|after_or_equal:'.$supplierPayment->getOriginal('date_of_issue'),
        ]);

        $supplierPayment->status = $request->status;
        if ($request->status == 'Drawn')
        {
            $supplierPayment->date_of_draw = $request->date;
            $supplierPayment->supplier->total_due -= $supplierPayment->amount;
        }
        $supplierPayment->push();

        toastr()->info('Status Updated');
        return redirect('/supplier-payment');
    }

    public function destroy(SupplierPayment $supplierPayment)
    {
        $supplierPayment->supplier->total_due += $supplierPayment->amount;
        $supplierPayment->push();
        $supplierPayment->delete();

        toastr()->warning('Record Deleted');
        return redirect('/supplier-payment');
    }

    public function restore($supplierPayment)
    {
        SupplierPayment::onlyTrashed()->find($supplierPayment)->restore();
        $supplierPayment = SupplierPayment::find($supplierPayment);
        $supplierPayment->supplier->total_due -= $supplierPayment->amount;
        $supplierPayment->push();

        toastr()->success('Entry Restored!');
        return back();
    }

    public function forceDelete($supplierPayment)
    {
        SupplierPayment::onlyTrashed()->find($supplierPayment)->forceDelete();

        toastr()->error('Entry Permanently Deleted!');
        return back();
    }
}
