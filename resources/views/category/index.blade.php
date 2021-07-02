@extends('layouts.app')

@section('style')
    <style>
        .icon{
            height: 20px;
            width: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-5">
        <h2>Categories</h2>
        <hr>
        @if($categories->count())
            <div class="card card-body bg-light ">
                <div class="table-responsive-lg">
                    @component('layouts.components.category-table', ['categories'=>$categories])
                        category
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
                {{ $categories->links() }}
            </div>
            <div class="flex-column">
                <a href="{{ route('category.create') }}" class="btn btn-success">Create New</a>
            </div>
        </div>
    </div>
@endsection
