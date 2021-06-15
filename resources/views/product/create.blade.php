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
    </style>
@endsection
@section('content')
    <div class="container m-auto">
        <h2>Create Product</h2>
        <hr>
        <form id="form" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                    <option value="" disabled selected>Please Select...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(old('category')==$category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>

                @error('category')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="unit">Unit</label>
                <select name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror" required>
                    <option value="" disabled selected>Please Select...</option>
                    <option value="Pieces" @if(old('unit')=='Pieces') selected @endif>Pieces</option>
                </select>

                @error('unit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="size">Size</label>
                <select name="size" id="size" class="form-control @error('size') is-invalid @enderror" required>
                    <option value="" disabled selected>Please Select...</option>
                    <option value="XS" @if(old('size')=='XS') selected @endif>XS</option>
                    <option value="S" @if(old('size')=='S') selected @endif>S</option>
                    <option value="M" @if(old('size')=='M') selected @endif>M</option>
                    <option value="L" @if(old('size')=='L') selected @endif>L</option>
                    <option value="XL" @if(old('size')=='XL') selected @endif>XL</option>
                    <option value="XXL" @if(old('size')=='XXL') selected @endif>XXL</option>
                </select>

                @error('size')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                    <option value="" disabled selected>Please Select...</option>
                    <option value="Male" @if(old('gender')=='Male') selected @endif>Male</option>
                    <option value="Female" @if(old('gender')=='Female') selected @endif>Female</option>
                    <option value="Other" @if(old('gender')=='Other') selected @endif>Other</option>
                </select>

                @error('gender')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="color">Color</label>
                <input type="text" id="color" name="color" class="form-control @error('color') is-invalid @enderror" value="{{ old('color') }}" required>

                @error('color')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="image_file">Image</label>

                <div id="image_file" class="custom-file">
                    <input id="image" name="image" type="file" class="custom-file-input @error('image') is-invalid @enderror">
                    <label for="image" class="custom-file-label">Image Name</label>

                    @error('image')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Create</button>
            <a href="{{ url()->previous() }}" class="btn btn-warning float-right">Cancel</a>
        </form>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function (){
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        });
    </script>
@endsection
