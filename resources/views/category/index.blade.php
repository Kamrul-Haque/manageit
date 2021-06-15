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
            <div class="flex-column"></div>
            <div class="flex-column">
                {{ $categories->links() }}
            </div>
            <div class="flex-column">
                <a href="{{ route('category.create') }}" class="btn btn-success">Create New</a>
            </div>
        </div>
    </div>
    <!-- The Modal -->
    @if($categories->count())
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
                        <form action="{{route('admin.clients.deleteAll')}}" method="post">
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
