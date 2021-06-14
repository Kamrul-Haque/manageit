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
    <div class="container py-4 m-auto">
        <div class="row mb-3">
            @foreach($categories as $category)
                <div class="col-md-2 mb-3 col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <img src="{{ $category->image ?? asset('images/No_Image_Available.jpg') }}" alt="category image" class="rounded-sm" height="100px" width="100px">
                            </div>
                            <h4 class="text-center font-weight-bolder mt-3">
                                <a href="#">{{ $category->name }}</a>
                            </h4>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('category.edit', $category) }}" class="btn btn-primary btn-sm">
                                    <span data-feather="edit" class="icon"></span>
                                </a>
                                @if(auth()->guard('admin')->check())
                                    <form action="{{ route('admin.category.destroy', $category) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm ml-1">
                                            <span data-feather="trash-2" class="icon"></span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <br>
        <hr>
        <div class="d-flex justify-content-between">
            <div class="flex-column"></div>
            <div class="flex-column">
                {{ $categories->links() }}
            </div>
            <div class="flex-column">
                <a href="{{ route('category.create') }}" class="btn btn-success">Create New</a>
            </div>
        </div>
    </div>
@endsection
