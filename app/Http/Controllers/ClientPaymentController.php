<?php

namespace App\Http\Controllers;

use App\CashRegister;
use App\Client;
use App\ClientPayment;
use Auth;
use Illuminate\Http\Request;

class ClientPaymentController extends Controller
{
    public function index()
    {
        $clientPayments = ClientPayment::latest()->paginate(10);
        return view('client-payment.index', compact('clientPayments'));
    }

    public function create()
    {
        $clients = Client::orderBy('name')->get();
        return view('client-payment.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client'=>'required',
            /*'type'=>'required',
            'cheque_no'=>'nullable|required_if:type,Cheque',
            'card'=>'nullable|required_if:type,Card',
            'validity'=>'nullable|required_if:type,Card',
            'cvv'=>'nullable|required_if:type,Card',*/
            'amount'=>'required|numeric|gt:0',
            'date'=>'required|before_or_equal:today',
        ]);

        $clientPayment = new ClientPayment;
        $clientPayment->client_id = $request->client;
        /*$clientPayment->type = $request->type;*/

        if ($request->type == 'Cheque')
        {
            $clientPayment->cheque_no = $request->cheque_no;
            $clientPayment->status = 'Pending';
        }
        else if ($request->type == 'Card')
        {
            $clientPayment->card_no = $request->card;
            $clientPayment->validity = $request->validity;
            $clientPayment->cvv = $request->cvv;
            $clientPayment->client->total_due -= $request->amount;
        }
        else
            $clientPayment->client->total_due -= $request->amount;

        $clientPayment->amount = $request->amount;
        $clientPayment->date_of_issue = $request->date;
        $clientPayment->received_by = Auth::user()->name;
        $clientPayment->push();
        $this->saveDeposit($request->amount, $request->date);

        toastr()->success('Created Successfully');
        return redirect('/client-payment');
    }

    public function saveDeposit($amount, $date)
    {
        $cash = new CashRegister;
        $cash->type = "Deposit";
        $cash->amount = $amount;
        $cash->title = "Client Payment";
        $cash->date = $date;
        $cash->save();
    }

    public function show(ClientPayment $clientPayment)
    {
        return view('client-payment.show', compact('clientPayment'));
    }

    public function edit(ClientPayment $clientPayment)
    {
        return view('client-payment.edit', compact('clientPayment'));
    }

    public function update(Request $request, ClientPayment $clientPayment)
    {
        $request->validate([
            'status'=>'required',
            'date'=>'nullable|required_if:status,Drawn|before_or_equal:today|after_or_equal:'.$clientPayment->getOriginal('date_of_issue'),
        ]);

        $clientPayment->status = $request->status;
        if ($request->status == 'Drawn')
        {
            $clientPayment->date_of_draw = $request->date;
            $clientPayment->client->total_due -= $clientPayment->amount;
        }
        $clientPayment->push();

        toastr()->info('Status Updated');
        return redirect('/client-payment');
    }

    public function destroy(ClientPayment $clientPayment)
    {
        $clientPayment->client->total_due += $clientPayment->amount;
        $clientPayment->push();
        $clientPayment->delete();

        toastr()->warning('Record Deleted');
        return redirect('/client-payment');
    }

    public function restore($clientPayment)
    {
        ClientPayment::onlyTrashed()->find($clientPayment)->restore();
        $clientPayment = ClientPayment::find($clientPayment);
        $clientPayment->client->total_due -= $clientPayment->amount;
        $clientPayment->push();

        toastr()->success('Entry Restored!');
        return back();
    }

    public function forceDelete($clientPayment)
    {
        ClientPayment::onlyTrashed()->find($clientPayment)->forceDelete();

        toastr()->error('Entry Permanently Deleted!');
        return back();
    }
}
