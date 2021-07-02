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
    @foreach ($clientPayments as $payment)
        <tr>
            <td> {{$loop->index + 1}} </td>
            <td> {{$payment->client->name}} </td>
            <td> {{$payment->amount}} </td>
            <td> {{$payment->date_of_issue}} </td>
            <td> {{$payment->received_by}} </td>
            <td>
                <div class="row justify-content-center">
                    <a class="btn btn-success float-right" href="{{route('client.payment.print',$payment)}}"><span data-feather="printer" style="width: 15px; height: 15px; padding: 0; margin-right: 3px"></span></a>
                    @auth('admin')
                        @if($slot == 'trash')
                            <form action="{{route('admin.client-payment.restore', $payment)}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm ml-1" title="restore"><span data-feather="rotate-ccw" style="height: 15px; width: 15px; padding: 0"></span></button>
                            </form>
                        @else
                            @if($payment->status == 'Pending')
                                <a class="btn btn-outline-primary btn-sm d-inline-block" href="{{ route('client-payment.edit', $payment) }}">Change Status</a>
                            @endif
                        @endif
                        <button class="btn @if($slot == 'trash') btn-danger @else btn-warning @endif btn-sm ml-1" title="delete" data-toggle="modal" data-target="#delete{{$loop->index}}">
                            <span data-feather="trash-2" style="height: 15px; width: 15px; padding: 0"></span>
                        </button>
                        @component('layouts.components.delete-modal')
                            @if($slot == 'trash')
                                action="{{route('admin.client-payment.force.delete', $payment)}}"
                            @else
                                action="{{route('admin.client-payment.destroy', $payment)}}"
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
