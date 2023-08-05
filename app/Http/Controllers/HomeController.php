<?php

namespace App\Http\Controllers;

use Hash;
use App\User;
use App\Entry;
use App\Client;
use App\Invoice;
use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $salesToday = Invoice::where('date', Carbon::today()->toDateString())->sum('grand_total');
        $entriesToday = Entry::where('date', Carbon::today()->toDateString())->sum('buying_price');
        $newClients = Client::whereDate('created_at', Carbon::today())->count();
        $newSuppliers = Supplier::whereDate('created_at', Carbon::today())->count();

        return view('dashboard', compact('salesToday', 'entriesToday', 'newClients', 'newSuppliers'));
    }

    public function passwordChangeForm()
    {
        return view('auth.passwords.change-password');
    }

    public function passwordChange(Request $request)
    {
        $id = $request->input('id');

        $user = User::find($id);
        if (Hash::check($request->input('old'), $user->password)) {
            if ($request->input('password') == $request->input('password_confirmation')) {
                $user->password = Hash::make($request->input('password'));
                $user->save();

                Auth::logout();
                toastr()->success('Password Changed Successfully');
                return redirect('/login');
            } else {
                toastr()->warning('New Passwords don\'t Match');
                return back();
            }
        } else {
            toastr()->error('Old Passwords don\'t Match');
            return back();
        }
    }
}
