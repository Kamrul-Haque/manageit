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
        a.btn-primary{
            margin-left: 3px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pr-5 pl-5">
        <h2>Invoices</h2>
        <hr>
        @if($invoices->count())
            <div class="card card-body bg-light">
                <div class="table-responsive-lg">
                    @component('layouts.components.invoice-table', ['invoices'=>$invoices])
                        invoice
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
                    {{ $invoices->links() }}
                </ul>
            </div>
            <div class="flex-column">
                <a class="btn btn-success float-left" href="{{route('invoices.create')}}">Add Invoice</a>
                <a class="btn btn-primary float-left" href=" {{route('quotation.print')}} ">Quotation</a>
            </div>
        </div>
    </div>
@endsection
