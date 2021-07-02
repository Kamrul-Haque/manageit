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
        .container{
            width: 65%;
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
    <div class="container">
        <h2>Cash Register</h2>
        <hr>
        @if($cashs->count())
            <div class="card card-body bg-light">
                <div class="table-responsive-lg">
                    @component('layouts.components.cash-register-table', ['cashs'=>$cashs])
                        cash
                    @endcomponent
                </div>
            </div>
        @else
            <div class="card card-body bg-light text-center">
                <p class="display-4">No Records Found!</p>
            </div>
        @endif
        <hr>
        <div class="d-flex justify-content-between">
            <div class="flex-column">
                <a class="btn btn-light" href=" {{route('admin.dashboard')}} ">Back</a>
            </div>
            <div class="flex-column">
                <ul class="pagination justify-content-center">
                    {{ $cashs->links() }}
                </ul>
            </div>
            <div class="flex-column justify-content-end">
                <a class="btn btn-success mr-1" href="{{ route('cash-register.withdraw') }}">Withdraw</a>
                <a class="btn btn-success mr-1" href="{{ route('cash-register.deposit') }}">Deposit</a>
            </div>
        </div>
    </div>
@endsection
