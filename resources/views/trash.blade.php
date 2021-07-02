@extends('layouts.app')

@section('style')
    <style>
        .dropdown-button{
            border: 0;
            background: transparent;
            color: black;
        }
        .dropdown-button:focus{
            outline: none;
            border: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid py-4 px-5">
        <h2>Deleted Records</h2>
        <hr>
        <div class="accordion" id="accordionCategory">
            <div class="card">
                <div class="card-header" id="bank-deposit">
                    <h4 class="mb-0">
                        <button class="dropdown-button btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-category" aria-expanded="true" aria-controls="collapseOne">
                            Categories
                        </button>
                    </h4>
                </div>
                <div id="collapse-category" class="collapse @if($categories->count()) show @endif" aria-labelledby="category" data-parent="#accordionCategory">
                    <div class="card-body">
                        @if($categories->count())
                            @component('layouts.components.category-table', ['categories'=>$categories])
                                trash
                            @endcomponent
                        @else
                            <h4 class="text-center"><strong>No Records Found</strong></h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <span class="d-flex justify-content-center mt-2">{{ $categories->links() }}</span>
        <br>
        <div class="accordion" id="accordionProduct">
            <div class="card">
                <div class="card-header" id="product">
                    <h4 class="mb-0">
                        <button class="dropdown-button btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-product" aria-expanded="true" aria-controls="collapseOne">
                            Products
                        </button>
                    </h4>
                </div>
                <div id="collapse-product" class="collapse @if($products->count()) show @endif" aria-labelledby="product" data-parent="#accordionProduct">
                    <div class="card-body">
                        @if($products->count())
                            @component('layouts.components.product-table', ['products'=>$products])
                                trash
                            @endcomponent
                        @else
                            <h4 class="text-center"><strong>No Records Found</strong></h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <span class="d-flex justify-content-center mt-2">{{ $products->links() }}</span>
        <br>
        <div class="accordion" id="accordionSupplier">
            <div class="card">
                <div class="card-header" id="supplier">
                    <h4 class="mb-0">
                        <button class="dropdown-button btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-supplier" aria-expanded="true" aria-controls="collapseOne">
                            Suppliers
                        </button>
                    </h4>
                </div>
                <div id="collapse-supplier" class="collapse @if($suppliers->count()) show @endif" aria-labelledby="supplier" data-parent="#accordionSupplier">
                    <div class="card-body">
                        @if($suppliers->count())
                            @component('layouts.components.supplier-table', ['suppliers'=>$suppliers])
                                trash
                            @endcomponent
                        @else
                            <h4 class="text-center"><strong>No Records Found</strong></h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <span class="d-flex justify-content-center mt-2">{{ $suppliers->links() }}</span>
        <br>
        <div class="accordion" id="accordionEntries">
            <div class="card">
                <div class="card-header" id="entries">
                    <h4 class="mb-0">
                        <button class="dropdown-button btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-entries" aria-expanded="true" aria-controls="collapseOne">
                            Entries
                        </button>
                    </h4>
                </div>
                <div id="collapse-entries" class="collapse @if($entries->count()) show @endif" aria-labelledby="entries" data-parent="#accordionEntries">
                    <div class="card-body">
                        @if($entries->count())
                            @component('layouts.components.entries-table', ['entries'=>$entries])
                                trash
                            @endcomponent
                        @else
                            <h4 class="text-center"><strong>No Records Found</strong></h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <span class="d-flex justify-content-center mt-2">{{ $entries->links() }}</span>
        <br>
        <div class="accordion" id="accordionSupplierPayments">
            <div class="card">
                <div class="card-header" id="supplier-payments">
                    <h4 class="mb-0">
                        <button class="dropdown-button btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-supplier-payments" aria-expanded="true" aria-controls="collapseOne">
                            Supplier Payments
                        </button>
                    </h4>
                </div>
                <div id="collapse-supplier-payments" class="collapse @if($supplierPayments->count()) show @endif" aria-labelledby="supplier-payments" data-parent="#accordionSupplierPayments">
                    <div class="card-body">
                        @if($supplierPayments->count())
                            @component('layouts.components.supplier-payment-table', ['supplierPayments'=>$supplierPayments])
                                trash
                            @endcomponent
                        @else
                            <h4 class="text-center"><strong>No Records Found</strong></h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <span class="d-flex justify-content-center mt-2">{{ $supplierPayments->links() }}</span>
        <br>
        <div class="accordion" id="accordionClient">
            <div class="card">
                <div class="card-header" id="supplier">
                    <h4 class="mb-0">
                        <button class="dropdown-button btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-client" aria-expanded="true" aria-controls="collapseOne">
                            Clients
                        </button>
                    </h4>
                </div>
                <div id="collapse-client" class="collapse @if($clients->count()) show @endif" aria-labelledby="supplier" data-parent="#accordionClient">
                    <div class="card-body">
                        @if($clients->count())
                            @component('layouts.components.client-table', ['clients'=>$clients])
                                trash
                            @endcomponent
                        @else
                            <h4 class="text-center"><strong>No Records Found</strong></h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <span class="d-flex justify-content-center mt-2">{{ $clients->links() }}</span>
        <br>
        <div class="accordion" id="accordionInvoice">
            <div class="card">
                <div class="card-header" id="invoices">
                    <h4 class="mb-0">
                        <button class="dropdown-button btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-invoices" aria-expanded="true" aria-controls="collapseOne">
                            Invoices
                        </button>
                    </h4>
                </div>
                <div id="collapse-invoices" class="collapse @if($invoices->count()) show @endif" aria-labelledby="invoices" data-parent="#accordionInvoice">
                    <div class="card-body">
                        @if($invoices->count())
                            @component('layouts.components.invoice-table', ['invoices'=>$invoices])
                                trash
                            @endcomponent
                        @else
                            <h4 class="text-center"><strong>No Records Found</strong></h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <span class="d-flex justify-content-center mt-2">{{ $invoices->links() }}</span>
        <br>
        <div class="accordion" id="accordionClientPayments">
            <div class="card">
                <div class="card-header" id="supplier-payments">
                    <h4 class="mb-0">
                        <button class="dropdown-button btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-client-payments" aria-expanded="true" aria-controls="collapseOne">
                            Client Payments
                        </button>
                    </h4>
                </div>
                <div id="collapse-client-payments" class="collapse @if($clientPayments->count()) show @endif" aria-labelledby="client-payments" data-parent="#accordionClientPayments">
                    <div class="card-body">
                        @if($clientPayments->count())
                            @component('layouts.components.client-payment-table', ['clientPayments'=>$clientPayments])
                                trash
                            @endcomponent
                        @else
                            <h4 class="text-center"><strong>No Records Found</strong></h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <span class="d-flex justify-content-center mt-2">{{ $clientPayments->links() }}</span>
        <br>
        <div class="accordion" id="accordionGodown">
            <div class="card">
                <div class="card-header" id="godown">
                    <h4 class="mb-0">
                        <button class="dropdown-button btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-godown" aria-expanded="true" aria-controls="collapseOne">
                            Godowns
                        </button>
                    </h4>
                </div>
                <div id="collapse-godown" class="collapse @if($godowns->count()) show @endif" aria-labelledby="godown" data-parent="#accordionGodown">
                    <div class="card-body">
                        @if($godowns->count())
                            @component('layouts.components.godown-table', ['godowns'=>$godowns])
                                trash
                            @endcomponent
                        @else
                            <h4 class="text-center"><strong>No Records Found</strong></h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <span class="d-flex justify-content-center mt-2">{{ $godowns->links() }}</span>
        <br>
        <div class="accordion" id="accordionTransfer">
            <div class="card">
                <div class="card-header" id="transfer">
                    <h4 class="mb-0">
                        <button class="dropdown-button btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-transfer" aria-expanded="true" aria-controls="collapseOne">
                            Product Transfers
                        </button>
                    </h4>
                </div>
                <div id="collapse-transfer" class="collapse @if($productTransfers->count()) show @endif" aria-labelledby="transfer" data-parent="#accordionTransfer">
                    <div class="card-body">
                        @if($productTransfers->count())
                            @component('layouts.components.product-transfer-table', ['productTransfers'=>$productTransfers])
                                trash
                            @endcomponent
                        @else
                            <h4 class="text-center"><strong>No Records Found</strong></h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <span class="d-flex justify-content-center mt-2">{{ $productTransfers->links() }}</span>
        <br>
        <div class="accordion" id="accordionCash">
            <div class="card">
                <div class="card-header" id="cash">
                    <h4 class="mb-0">
                        <button class="dropdown-button btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-cash" aria-expanded="true" aria-controls="collapseOne">
                            Cash Registers
                        </button>
                    </h4>
                </div>
                <div id="collapse-cash" class="collapse @if($cashs->count()) show @endif" aria-labelledby="cash" data-parent="#accordionCash">
                    <div class="card-body">
                        @if($cashs->count())
                            @component('layouts.components.cash-register-table', ['cashs'=>$cashs])
                                trash
                            @endcomponent
                        @else
                            <h4 class="text-center"><strong>No Records Found</strong></h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <span class="d-flex justify-content-center mt-2">{{ $cashs->links() }}</span>
    </div>
@endsection
