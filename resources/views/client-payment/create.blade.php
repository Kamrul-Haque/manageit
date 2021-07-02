@extends('layouts.app')
@section('style')
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            margin: 0;
        }
        .container{
            width: 500px;
        }
        label{
            font-size: medium;
        }
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('content')
    <div class="container m-auto">
        <h2>Add Payment</h2>
        <hr>
        <form action="{{route('client-payment.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="client">Client Name</label>
                <select id="client" name="client" class="form-control @error('client') is-invalid @enderror" required>
                    <option value="" selected disabled>Please Select...</option>
                    @foreach ($clients as $client)
                        <option value="{{$client->id}}" @if(old('client') == $client->id) selected @endif>{{$client->name}}</option>
                    @endforeach
                </select>

                @error('client')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" step="any" id="amount" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" required>

                @error('amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group pb-1">
                <label for="date">Payment Date/Date of Issue</label>
                <input type="date" id="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" required>

                @error('date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Create</button>
            <a href="{{ route('client-payment.index') }}" class="btn btn-warning float-right">Cancel</a>
        </form>
    </div>
@endsection

