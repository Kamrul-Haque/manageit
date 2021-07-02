@extends('layouts.app')
@section('style')
    <style>
        .container{
            width: 65%;
        }
        a.btn-primary{
            margin-left: 3px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <h2>Products</h2>
        <hr>
        @if($products->count())
            <div class="card card-body bg-light">
                <div class="table-responsive-lg">
                    @component('layouts.components.product-table', ['products'=>$products])
                        product
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
                    {{ $products->links() }}
                </ul>
            </div>
            <div class="flex-column justify-content-end">
                <a class="btn btn-success float-left" href=" {{route('products.create')}} ">Create New</a>
                <a class="btn btn-primary float-left" href=" {{route('invoices.create')}} ">Sell </a>
            </div>
        </div>
    </div>
@endsection
