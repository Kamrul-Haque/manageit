<style>
    a.sidebar {
        -webkit-transition: .3s all ease;
        -o-transition: .3s all ease;
        transition: .3s all ease;
        color: dodgerblue;
        font-size: 20px;
    }
    a.child {
        -webkit-transition: .3s all ease;
        -o-transition: .3s all ease;
        transition: .3s all ease;
        font-size: 14px;
    }
    a:hover, a:focus {
        text-decoration: none !important;
        outline: none !important;
        -webkit-box-shadow: none;
        box-shadow: none;
    }
    #sidebar {
        position: fixed;
        width: 250px;
        min-height: 100%;
        max-height: 100%;
        background: #23272b;
        color: #fff;
        -webkit-transition: all 1s;
        -o-transition: all 1s;
        transition: all 1s;
        border-right: 1px solid rgba(255, 255, 255, 0.1);
        z-index: 3;
        box-shadow: 1px 3px rgba(255, 255, 255, 0.1);
        overflow-y: auto;
        overflow-x: hidden;
    }
    #sidebar ul.components {
        padding: 0;
    }
    #sidebar ul li {
        font-size: 16px;
    }
    #sidebar ul li > ul {
        margin-left: 10px;
    }
    #sidebar ul li > ul li {
        font-size: 14px;
    }
    #sidebar ul li a {
        padding: 15px 0;
        display: block;
        color: rgba(255, 255, 255, 0.8);
        /*border-bottom: 1px solid rgba(255, 255, 255, 0.1);*/
    }
    #sidebar ul li a:hover {
        color: lightseagreen;
    }
    #sidebar ul li a.active {
        background: transparent;
        color: lightseagreen;
        font-size: medium;
        font-weight: bold;
        transition: 0.35s;
    }

    #sidebar ul li a > .feather {
        margin-right: 4px
    }

    a[data-toggle="collapse"] {
        position: relative;
    }

    .dropdown-toggle::after {
        display: block;
        position: absolute;
        top: 50%;
        right: 0;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }
    .last:hover{
        color: white;
    }
    @media screen and (max-width: 576px){
        #sidebar{
            top: 65px;
            z-index: 9999;
            transition: width 0.5s ease-in-out;
        }
    }
    .open{
        width: 0 !important;
        border: 0 !important;
    }
</style>
<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar" class="add-padding pt-4">
        <div class="px-4">
            <ul class="list-unstyled components mb-5">
                @if(Auth::guard('admin')->check())
                    <li>
                        <a class="nav-link {{ Request::is('admin') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <span data-feather="layers"></span>
                            Dashboard
                        </a>
                    </li>
                @else
                    <li>
                        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <span data-feather="layers"></span>
                            Dashboard
                        </a>
                    </li>
                @endif
                <li>
                    <a class="nav-link {{ Request::is('category*') ? 'active' : '' }}" href="{{ route('category.index') }}">
                        <span data-feather="list"></span>
                        Categories
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                        <span data-feather="package"></span>
                        Products
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ Request::is('godowns*') ? 'active' : '' }}" href="{{ route('godowns.index') }}">
                        <span data-feather="archive"></span>
                        Warehouses
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ Request::is('product-transfers*') ? 'active' : '' }}" href="{{ route('product-transfers.index') }}">
                        <span data-feather="log-out"></span>
                        Transfers
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ Request::is('clients*') ? 'active' : '' }}" href="{{ route('clients.index') }}">
                        <span data-feather="briefcase"></span>
                        Clients
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ Request::is('suppliers*') ? 'active' : '' }}" href="{{ route('suppliers.index') }}">
                        <span data-feather="truck"></span>
                        Suppliers
                    </a>
                </li>
                @if(Auth::guard('admin')->check())
                    <li>
                        <a class="nav-link {{ Request::is('entries*') ? 'active' : '' }}" href="{{ route('entries.index') }}">
                            <span data-feather="file-plus"></span>
                            Entries
                        </a>
                    </li>
                @endif
                <li>
                    <a class="nav-link {{ Request::is('sale*') ? 'active' : '' }}" href="{{ route('product.sales') }}">
                        <span data-feather="dollar-sign"></span>
                        Sales
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ Request::is('invoices*') ? 'active' : '' }}" href="{{ route('invoices.index') }}">
                        <span data-feather="file-text"></span>
                        Invoices
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ Request::is('client-payment*') ? 'active' : '' }}" href="{{ route('client-payment.index') }}">
                        <span data-feather="plus-square"></span>
                        Client Payments
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ Request::is('supplier-payment*') ? 'active' : '' }}" href="{{ route('supplier-payment.index') }}">
                        <span data-feather="minus-square"></span>
                        Supplier Payments
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ Request::is('cash-register*') ? 'active' : '' }}" href="{{ route('cash-register.index') }}">
                        <span data-feather="inbox"></span>
                        Cash Register
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ Request::is('bank-account*') ? 'active' : '' }}" href="{{ route('bank-account.index') }}">
                        <span data-feather="home"></span>
                        Bank Accounts
                    </a>
                </li>
                @if(Auth::guard('admin')->check())
                    <li>
                        <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                            <span data-feather="users"></span>
                            Employees
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/accounts*') ? 'active' : '' }}" href="{{ route('admin.accounts.index') }}">
                            <span data-feather="user"></span>
                            Admins
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/trash*') ? 'active' : '' }}" href="{{ route('admin.trash') }}">
                            <span data-feather="trash"></span>
                            Trash
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</div>


