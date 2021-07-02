<?php

namespace App\Http\Controllers;

use App\BankAccount;
use App\BankDeposit;
use App\BankWithdraw;
use DB;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function index()
    {
        $bankAccounts = BankAccount::latest()->paginate(10);
        return view('bank-accounts.index', compact('bankAccounts'));
    }

    public function create()
    {
        return view('bank-accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
           'bank'=>'required|string|min:4',
           'branch'=>'required|string|min:4',
           'account_no'=>'required|integer|min:5|unique:bank_accounts',
           'balance'=>'nullable|numeric',
        ]);

        $bankAccount = new BankAccount;
        $bankAccount->bank_name = $request->bank;
        $bankAccount->branch = $request->branch;
        $bankAccount->account_no = $request->account_no;
        $bankAccount->balance = $request->balance ?? 0;
        $bankAccount->save();

        toastr()->success('Created Successfully');
        return redirect('/bank-account');
    }

    public function show(BankAccount $bankAccount)
    {
        $bankDeposits = BankDeposit::where('bank_account_id', $bankAccount->id)->get();
        $bankWithdraws = BankWithdraw::where('bank_account_id', $bankAccount->id)->get();
        return view('bank-accounts.show', compact('bankAccount', 'bankDeposits','bankWithdraws'));
    }

    public function edit(BankAccount $bankAccount)
    {
        return view('bank-accounts.edit', compact('bankAccount'));
    }

    public function update(Request $request, BankAccount $bankAccount)
    {
        $request->validate([
            'bank'=>'required|string|min:4',
            'branch'=>'required|string|min:4',
            'account_no'=>'required|integer|min:5|unique:bank_accounts,account_no,'.$bankAccount->id,
            'balance'=>'nullable|numeric',
        ]);

        $bankAccount->bank_name = $request->bank;
        $bankAccount->branch = $request->branch;
        $bankAccount->account_no = $request->account_no;
        $bankAccount->balance = $request->balance;
        $bankAccount->save();

        toastr()->info('Updated Successfully');
        return redirect('/bank-account');
    }

    public function destroy(BankAccount $bankAccount)
    {
        $bankAccount->delete();

        toastr()->warning('Record Deleted');
        return redirect('/bank-account');
    }

    /*public function destroyAll()
    {
        DB::table('bank_accounts')->delete();

        toastr()->error('All Records Deleted');
        return redirect('/bank-account');
    }*/

    public function restore($bankAccount)
    {
        BankAccount::onlyTrashed()->find($bankAccount)->restore();

        toastr()->success('Entry Restored!');
        return back();
    }

    public function forceDelete($bankAccount)
    {
        BankAccount::onlyTrashed()->find($bankAccount)->forceDelete();

        toastr()->error('Entry Permanently Deleted!');
        return back();
    }
}
