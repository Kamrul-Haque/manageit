@extends('layouts.app')

@section('content')
    <div class="container-fluid px-5">
        <h2>Products of {{ $category->name }}</h2>
        <hr>
        @if($category->products->count())
            <div class="card card-body bg-light ">
                <div class="table-responsive-lg">
                    @component('layouts.components.product-table', ['products'=>$category->products])
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
                <a href="{{ route('admin.dashboard') }}" class="btn btn-light">Back</a>
            </div>
            <div class="flex-column">
                {{--{{ $category->products->links() }}--}}
            </div>
            <div class="flex-column">
                <a href="{{ route('products.create') }}" class="btn btn-success">Create New</a>
            </div>
        </div>
    </div>
@endsection
