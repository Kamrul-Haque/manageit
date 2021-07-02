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
@endsection
@section('content')
    <div class="container">
        <h2>Godowns</h2>
        <hr>
        @if($godowns->count())
            <div class="card card-body bg-light">
                @component('layouts.components.godown-table', ['godowns'=>$godowns])
                    godowns
                @endcomponent
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
                    {{ $godowns->links() }}
                </ul>
            </div>
            <div class="flex-column">
                <a class="btn btn-success float-left" href=" {{route('godowns.create')}} ">Create New</a>
            </div>
        </div>
    </div>
@endsection
