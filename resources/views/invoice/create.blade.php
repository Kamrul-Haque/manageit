@extends('layouts.app')

@section('style')
    <style>
        .container{
            width: 30vw;
        }
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            margin: 0;
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
        .modal-lg {
            max-width: 1500px !important;
            padding-left: 20px;
        }
        .modal-md{
            max-width: 45% !important;
            padding-left: 200px;
        }
        input {
            text-align: right;
        }
    </style>
    <script>var categories = {!! $categories !!}</script>
    <script>var inc = "{{asset('/icons/trash-2.svg')}}"</script>
@endsection

@section('content')
    <div class="container-fluid px-5">
        <h3>Sell Product</h3>
        <hr>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong class="text-danger">{{ $error }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endforeach
        @endif
        <form action="{{route('invoices.store')}}" method="POST">
            @csrf
            <section id="products">
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="form-check-label">Category</label>
                    </div>
                    <div class="col-sm-2">
                        <label class="form-check-label">Product Name</label>
                    </div>
                    <div class="col-sm-2">
                        <label class="form-check-label">Gododwn</label>
                    </div>
                    <div class="col-sm-1">
                        <label class="form-check-label">Color</label>
                    </div>
                    <div class="col-sm-1">
                        <label class="form-check-label">Size</label>
                    </div>
                    <div class="col-sm-1">
                        <label class="form-check-label">Quantity</label>
                    </div>
                    <div class="col-sm-1">
                        <label class="form-check-label">Unit Price</label>
                    </div>
                    <div class="col-sm-1 text-right">
                        <label class="form-check-label">Total Price</label>
                    </div>
                    <div class="col-sm-1 text-right">
                        <label class="form-check-label">Action</label>
                    </div>
                </div>
                <div id="body">
                    <div id="formRow" class="form-group row productRow">
                        <div class="col-sm-2">
                            <select name="category[]" id="category[]" class="form-control category" data-dependent="pname" required>
                                <option value="" disabled selected>Please Select...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select name="pname[]" id="pname" class="form-control dynamic" data-dependent="godown" data-size="sizeLabel" data-color="colorLabel" required>
                                <option selected disabled>Please Select...</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select id="godown" name="godown[]" class="form-control" required>
                                <option selected disabled>Please Select...</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <label id="colorLabel" class="form-check-label text-black-50"></label>
                        </div>
                        <div class="col-sm-1">
                            <label id="sizeLabel" class="form-check-label text-black-50"></label>
                        </div>
                        <div class="col-sm-1">
                            <input type="number" id="quantity" name="quantity[]" class="form-control calculable" data-dependent="price" data-linked="uprice" required>
                        </div>

                        <div class="col-sm-1">
                            <input type="number" id="unitp" name="uprice[]" class="form-control calculable-alt" data-dependent="price" data-linked="quantity" required>
                        </div>
                        <div class="col-sm-1 text-right">
                            <label id="priceLabel" class="form-check-label text-black-50">0</label>
                            <input type="number" step="any" id="price" name="price[]" data-output="priceLabel" hidden>
                        </div>
                        <div class="col-sm-1 text-right">
                            <button id="remove"  type="button" class="btn btn-danger btn-sm"><img src="{{asset('/icons/trash-2.svg')}}" alt="delete" width="15px"></button>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" id="add" class="btn btn-primary btn-sm">Add</button>
                    <button type="button" id="calculate" class="btn btn-success btn-sm">Calculate</button>
                </div>
            </section>
            <br>
            <section id="others">
                <div class="container mr-0">
                    <div class="form-group row">
                        <label for="date" class="col-form-label col-4">Selling Date</label>
                        <input type="date" id="date" name="date" class="form-control col-8" value="{{ old('date') }}" required>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-form-label col-4">Client Name</label>
                        <select id="name" name="client" class="form-control col-8" required>
                            <option value="" selected disabled>Please Select...</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" @if(old('name')==$client->id) selected @endif>{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-4">Subtotal:</label>
                        <label id="subtotal" class="col-8 text-right pr-0">0</label>
                        <input type="number" step="any" name="subtotal" hidden>
                    </div>
                    <div class="form-group row">
                        <label for="discount" class="col-form-label col-4">Discount:</label>
                        <input type="number" step="any" id="discount" name="discount" class="form-control col-8" value="{{ old('discount') }}" required>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-4">Grand Total:</label>
                        <label id="gtotal" class="col-8 text-right pr-0">0</label>
                        <input type="number" step="any" name="gtotal" hidden>
                    </div>
                    {{--<div class="form-group">
                        <label for="type">Type</label>
                        <select id="type" name="type" class="form-control" required>
                            <option value="" selected disabled>Please Select...</option>
                            <option value="Cash" @if(old('type')=="Cash") selected @endif>Cash</option>
                            <option value="Cheque" @if(old('type')=="Cheque") selected @endif>Cheque</option>
                            <option value="Card" @if(old('type')=="Cheque") selected @endif>Card</option>
                        </select>
                    </div>--}}
                    <div class="form-group row">
                        <label for="amount" class="col-form-label col-4">Amount</label>
                        <input type="number" step="any" id="amount" name="amount" class="form-control col-8" value="{{ old('amount') }}" required>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-4">Due:</label>
                        <label id="due" class="col-8 text-right pr-0">0</label>
                        <input type="number" step="any" name="due" hidden>
                    </div>
                </div>
            </section>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ url()->previous() }}" class="btn btn-warning">Cancel</a>
                <button type="submit" class="btn btn-success">Confirm</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var count = 2;

        $(function() {
            var totalProductPrice;
            var discount = 0;
            var subTotal;
            var grandTotal;
            var paid = 0;
            var due;

            $('#calculate').click(function () {

                totalProductPrice = 0;

                $('input[id*="price"]').each(function () {
                    totalProductPrice += parseFloat($(this).val());
                });

                $('input[name="subtotal"]').val(totalProductPrice);
                $('#subtotal').html(totalProductPrice);
            });

            $(document).on('input', '#discount', function () {
                discount = parseFloat($(this).val());

                subTotal = parseFloat(totalProductPrice) ;
                grandTotal = parseFloat(subTotal - discount);

                $('input[name="gtotal"]').val(grandTotal);
                $('#gtotal').html(grandTotal);
            });

            $(document).on('input','#amount', function (){
                paid = parseFloat($(this).val());

                due = parseFloat(grandTotal - paid);

                $('input[name="due"]').val(due);
                $('#due').html(due);
            })
        });

        $('#add').click(function () {

            var element = `<div id="formRow" class="form-group row productRow">
                                <div class="col-sm-2">
                                    <select name="category[`+count+`]" class="form-control category" data-dependent="pname`+count+`" required>
                                        <option selected disabled>Please Select...</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <select name="pname[`+count+`]" id="pname`+count+`" class="form-control dynamic" data-dependent="godown`+count+`" data-size="sizeLabel`+count+`" data-color="colorLabel`+count+`" required>
                                        <option selected disabled>Please Select...</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <select id="godown`+count+`" name="godown[]" class="form-control" required>
                                        <option selected disabled>Please Select...</option>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <label id="colorLabel`+count+`" class="form-check-label text-black-50"></label>
                                </div>
                                <div class="col-sm-1">
                                    <label id="sizeLabel`+count+`" class="form-check-label text-black-50"></label>
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" id="quantity`+count+`" name="quantity[]" class="form-control calculable" data-dependent="price`+count+`" data-linked="uprice`+count+`" required>
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" id="unitp`+count+`" name="uprice[]" class="form-control calculable-alt" data-dependent="price`+count+`" data-linked="quantity`+count+`" required>
                                </div>
                                <div class="col-sm-1 text-right">
                                    <label id="priceLabel`+count+`" class="form-check-label text-black-50">0</label>
                                    <input type="number" step="any" id="price`+count+`" name="price[]" data-output="priceLabel`+count+`" hidden>
                                </div>
                                <div class="col-sm-1 text-right">
                                    <button id="remove"  type="button" class="btn btn-danger btn-sm"><img src="`+inc+`" width="15px" alt="delete"></button>
                                </div>
                            </div>
                        </div>`;

            $('#body').append(element);

            $.each(categories, function (index, product) {
                $('.category:last').append('<option value="'+product.id+'">'+product.name+'</option>');
            });

            count++;
        });

        $(document).on('click', '#remove', function () {
            productRows = $('.productRow').length;
            if (productRows>1)
                $(this).closest('#formRow').remove();
        });

        /*$(document).on('change','#type',function () {
            var type = $(this).val();

            $('.added').remove();
            if (type === 'Cheque')
            {
                var html = `<div class="form-group pt-3 added">
                                 <label for="account">Account No.</label>
                                 <input type="number" id="account" name="account" class="form-control" required>
                             </div>`;

                $(html).insertAfter(this);
            }
            if(type === 'Card')
            {
                var html = `<div class="form-group pt-3 added">
                                 <label for="card">Card No.</label>
                                 <input type="number" id="card" name="card" class="form-control" required>
                             </div>
                            <div class="form-group row added">
                                <div class="col-md-6">
                                    <label for="validity">Validity</label>
                                    <input type="text" id="validity" name="validity" class="form-control" placeholder="07/20" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="cvv">CVV</label>
                                    <input type="number" id="cvv" name="cvv" class="form-control">
                                </div>
                            </div>`;

                $(html).insertAfter(this);
            }
        });*/

        $(document).on('change', '.category', function () {
            var category = $(this).val();
            var dependent = $(this).data('dependent');
            $('#'+dependent).empty();
            $('#'+dependent).append('<option selected disabled>Please Select...</option>');
            if (category) {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('get.products')}}",
                    method: "POST",
                    data: {category: category, _token: _token},
                    success: function (response) {
                        $.each(response, function (index, product) {
                            $('#'+dependent).append('<option value="' + product.id + '">' + product.name + '</option>');
                        });
                    }
                });
            }
        });

        $(document).on('change', '.dynamic', function () {
            var p_id = $(this).val();
            var dependent = $(this).data('dependent');
            var size = $(this).data('size');
            var color = $(this).data('color');
            $('#'+dependent).empty();
            $('#'+dependent).append('<option selected disabled>Please Select...</option>');
            if(p_id)
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{route('invoices.getGodowns')}}",
                    method:"POST",
                    data:{id:p_id, _token:_token},
                    success:function (response) {
                        $.each(response, function (index, godown) {
                            $('#'+dependent).append('<option value="'+godown.id+'">'+godown.name+' - '+godown.pivot.quantity+'</option>');
                        });
                    }
                });
            }
            getSize(p_id, size);
            getColor(p_id, color);
        });

        $(document).on('input', '.calculable', function () {
            var quantity = $(this).val();
            var linked = $(this).data('linked');
            var uprice = $('#'+linked).val();
            var dependent = $(this).data('dependent');
            var output = $('#'+dependent).data('output');

            if (quantity && uprice)
            {
                $('#'+output).html(quantity * uprice);
                $('#'+dependent).val(quantity * uprice);
            }
        });

        $(document).on('input', '.calculable-alt', function () {
            var uprice = $(this).val();
            var linked = $(this).data('linked');
            var quantity = $('#'+linked).val();
            var dependent = $(this).data('dependent');
            var output = $('#'+dependent).data('output');

            if (quantity && uprice)
            {
                $('#'+output).html(quantity * uprice);
                $('#'+dependent).val(quantity * uprice);
            }
        });

        function getSize(id, field) {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{route('invoices.getSize')}}",
                method:"POST",
                data:{id:id, _token:_token},
                success:function (response) {
                    $('#'+field).html(response);
                }
            });
        }

        function getColor(id, field) {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{route('invoices.getColor')}}",
                method:"POST",
                data:{id:id, _token:_token},
                success:function (response) {
                    $('#'+field).html(response);
                }
            });
        }
    </script>
@endsection
