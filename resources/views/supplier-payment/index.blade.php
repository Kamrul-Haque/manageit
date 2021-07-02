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
@endsection
@section('content')
    <div class="container-fluid pl-5 pr-5">
        <h2>Payments</h2>
        <hr>
        @if($supplierPayments->count())
            <div class="card card-body bg-light">
                <div class="table-responsive-lg">
                    @component('layouts.components.supplier-payment-table',['supplierPayments'=>$supplierPayments])
                        supplierPayment
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
                    {{ $supplierPayments->links() }}
                </ul>
            </div>
            <div class="flex-column">
                <a class="btn btn-success float-left" href=" {{route('supplier-payment.create')}} ">Add New</a>
            </div>
        </div>
    </div>
@endsection
