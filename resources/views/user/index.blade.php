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
        th{
            background-color: #23272b;
            color: whitesmoke;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-5 pr-5 main-wrapper">
        <h2>Employee Accounts</h2>
        <hr>
        @if($users->count())
        <div class="card card-body bg-light">
            <div class="table-responsive-lg">
                <table class="table table-striped table-hover pt-3" id="table">
                        <tr>
                            <th>#</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>JOB TITLE</th>
                            <th>NID NUMBER</th>
                            <th>PHONE</th>
                            <th>DATE OF BIRTH</th>
                            <th>ADDRESS</th>
                            <th class="text-center">OPERATIONS</th>
                        </tr>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$user->name}} </td>
                                <td> {{$user->email}} </td>
                                <td> {{$user->job_title}} </td>
                                <td> {{$user->nid}} </td>
                                <td> {{$user->phone}} </td>
                                <td> {{$user->date_of_birth}} </td>
                                <td> {{$user->address}} </td>
                                <td>
                                    <div class="row justify-content-center">
                                        <a href="{{route('admin.users.edit',$user->id)}} " class="btn btn-primary btn-sm" title="edit"><span data-feather="edit" style="height: 15px; width: 15px; padding: 0"></span></a>
                                        <button class="btn btn-warning btn-sm" title="delete" data-toggle="modal" data-target="#delete{{$loop->index}}">
                                            <span data-feather="trash-2" style="height: 15px; width: 15px; padding: 0"></span>
                                        </button>
                                        @component('layouts.components.delete-modal')
                                            action="{{route('admin.users.destroy', $user)}}"
                                            @slot('loop') {{$loop->index}} @endslot
                                        @endcomponent
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="card card-body bg-light text-center">
            <p class="display-4">No Records Found!</p>
        </div>
        @endif
        <hr>
        <div class="d-flex flex-column">
            <div class="flex-column">
                <a class="btn btn-light" href=" {{route('admin.dashboard')}} ">Back</a>
            </div>
            <div class="flex-column">
                <ul class="pagination justify-content-center">
                    {{ $users->links() }}
                </ul>
            </div>
            <div class="flex-column">
                <a class="btn btn-success float-left" href=" {{route('admin.users.create')}} ">Add Employee</a>
            </div>
        </div>
    </div>
@endsection
