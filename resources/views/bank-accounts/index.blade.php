@extends('layouts.app')
@section('style')
    <style>
        html, body, th {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            margin: 0;
        }
    </style>
    @if(Auth::guard('admin')->check())
        <style>
            th{
                background-color: #23272b;
                color: whitesmoke;
            }
        </style>
    @else
        <style>
            th{
                background-color: #3490dc;
                color: whitesmoke;
            }
        </style>
    @endif
@endsection
@section('content')
    <div class="container-fluid pl-5 pr-5">
        <a class="btn btn-light" href=" {{route('admin.dashboard')}} ">Back</a>
        <h2 style="float: right">Bank Accounts</h2>
        <hr>
        @if($bankAccounts->count())
            <div class="card card-body bg-light">
                <div class="table-responsive-lg">
                    @component('layouts.components.bank-account-table', ['bankAccounts'=>$bankAccounts])
                        bank
                    @endcomponent
                </div>
            </div>
        @else
            <div class="card card-body bg-light text-center">
                <p class="display-4">No Records Found!</p>
            </div>
        @endif
        <hr>
        <div class="form-group row">
            <div class="col-md-3">
                <a class="btn btn-success float-left" href=" {{route('bank-account.create')}} ">Add New</a>
                <a class="btn btn-outline-success float-left ml-1" href=" {{route('bank-deposit.create')}} ">Deposit</a>
            </div>
            <div class="col-md-6">
                <ul class="pagination justify-content-center">
                    {{ $bankAccounts->links() }}
                </ul>
            </div>
            <div class="col-md-3">
                @auth('admin')
                <button type="button" id="rightbutton" class="btn btn-danger float-right" data-toggle="modal" data-target="#deleteAllModal">Delete All</button>
                @endauth
                <a class="btn btn-outline-danger float-right mr-1" href=" {{route('bank-withdraw.create')}} ">Withdraw</a>
            </div>
        </div>
    </div>
    <!-- The Modal -->
    @if($bankAccounts->count())
        <div class="modal fade" id="deleteAllModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title">Delete Confirmation</p>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body text-danger font-weight-bold">
                        <h4>Do you really want to delete all the records!</h4>
                    </div>

                    <div class="modal-footer">
                        <form action="{{ route('admin.bank-account.deleteAll') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Confirm</button>
                        </form>
                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection