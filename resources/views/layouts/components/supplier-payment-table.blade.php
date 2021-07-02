<table class="table table-bordered table-striped" id="table">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Client Name</th>
            <th>Amount</th>
            <th>Payment Date</th>
            <th>Received By</th>
            <th>OPERATIONS</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($supplierPayments as $payment)
        <tr>
            <td> {{$loop->index + 1}} </td>
            <td> {{$payment->supplier->name}} </td>
            <td> {{$payment->amount}} </td>
            <td> {{$payment->date_of_issue}} </td>
            <td> {{$payment->received_by}} </td>
            <td>
                <div class="row justify-content-center">
                    @auth('admin')
                        @unless($slot == 'supplierPayment')
                            <form action="{{route('admin.supplier-payment.restore', $payment)}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm ml-1" title="restore"><span data-feather="rotate-ccw" style="height: 15px; width: 15px; padding: 0"></span></button>
                            </form>
                        @else
                            @if($payment->status == 'Pending')
                                <a class="btn btn-outline-primary btn-sm d-inline-block" href="{{ route('supplier-payment.edit', $payment) }}">Change Status</a>
                            @endif
                        @endunless
                        <button class="btn @unless($slot == 'supplierPayment') btn-danger @else btn-warning @endunless btn-sm ml-1" title="delete" data-toggle="modal" data-target="#delete{{$loop->index}}">
                            <span data-feather="trash-2" style="height: 15px; width: 15px; padding: 0"></span>
                        </button>
                        @component('layouts.components.delete-modal')
                            @if($slot == 'supplierPayment')
                                action="{{route('admin.supplier-payment.destroy', $payment)}}"
                            @else
                                action="{{route('admin.supplier-payment.force.delete', $payment)}}"
                            @endif
                            @slot('loop') {{$loop->index}} @endslot
                        @endcomponent
                    @endauth
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
