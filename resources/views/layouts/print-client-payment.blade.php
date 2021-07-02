<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .borderless{
            border-left: 1px solid transparent !important;
            border-bottom: 1px solid transparent !important;
        }
        @media print {

            th.print{
                border: 1px solid black !important;
            }
            td.print{
                border: 1px solid black !important;
            }
            td.borderless{
                border-left: 1px solid transparent !important;
                border-bottom: 1px solid transparent !important;
            }
            .print-bottom{
                position: fixed;
                bottom: 0;
            }
            .btn{
                display: none;
            }
            hr.line {
                border: 1px solid black;
            }
        }
    </style>
</head>
<body>
    <div class="container pt-3">
        <img src="{{asset('images/invoice-banner.png')}}" width="100%" alt="Lota Fashion">
        <hr class="line">
        <div class="row">
            <div class="col-sm-10">
                <h5>Client:</h5>
                <h5><strong>{{ $clientPayment->client->name }}</strong></h5>
                <h6>{{ $clientPayment->client->phone }}</h6>
                <h6>{{ $clientPayment->client->address }}</h6>
                <h6>{{ $clientPayment->client->email }}</h6>
            </div>
            <div class="col-sm-2">
                <span class="float-right">{{ $clientPayment->sl_no }}</span>
                <br>
                <span class="float-right"><strong>{{ $clientPayment->date_of_issue }}</strong></span>
                <br>
            </div>
        </div>
        <br>
        <div class="table-responsive-sm">
            <table class="table table-bordered" id="table">
                <thead class="thead-light">
                    <tr>
                        <th class="print">#</th>
                        <th class="print">Payment method</th>
                        <th class="print" style="text-align: right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="print"> 1 </td>
                        <td class="print"> {{$clientPayment->type}} </td>
                        <td class="print" style="text-align: right"> {{number_format($clientPayment->amount, 2)}} </td>
                    </tr>
                </tbody>
            </table>
            <div class="row pt-3">
                <div class="col-md-6">
                    <button id="print" type="button" class="btn btn-block btn-info"><span data-feather="printer" style="height: 15px; width: 15px; padding: 0"></span>Print</button>
                </div>
                <div class="col-md-6">
                    <a type="button" class="btn btn-block btn-warning" href="{{url()->previous()}}">Cancel</a>
                </div>
            </div>
        </div>
        <br>
        <div class="container print-bottom">
            <p>-------------------------<br>Authorization Signature</p>
        </div>
    </div>
</body>
<script>
    feather.replace();
</script>
<script type="text/javascript">
    $(document).on('click','#print',function () {
        window.print();
    });

    $(function(){
        window.onafterprint = function () {
            window.location.replace("{{route('admin.dashboard')}}");
        }
    });
</script>
</html>
