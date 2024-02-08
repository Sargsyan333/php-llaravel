@section('menu')

<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel" style="height: 40px">
        <div class="pull-left info">
            <p>{{ auth()->user()->name }} <span><i class="fa fa-circle text-success"></i> Online</span></p>
        </div>
    </div>

    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li>
            <a href="{{ url('/administration/dashboard') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>

        <li class="treeview {{ (request()->segment(2) == 'users') ? 'menu-open' : '' }}">
            <a href="#">
                <i class="fa fa-user"></i>
                <span>Users</span>
                <span class="pull-right-container">
            </span>
            </a>
            <ul class="treeview-menu" style="{{ (request()->segment(2) == 'users') ? 'display:block' : '' }}">
                <li><a href="{{ url('/administration/users') }}"><i class="fa fa-circle-o"></i> User List</a></li>
                <li><a href="{{ url('/administration/users/create') }}"><i class="fa fa-circle-o"></i> Add user</a></li>
            </ul>
        </li>

        <li class="treeview {{ (request()->segment(2) == 'products') ? 'menu-open' : '' }}">
            <a href="#">
                <i class="fa fa-product-hunt" aria-hidden="true"></i>
                <span>Products</span>
                <span class="pull-right-container">
            </span>
            </a>
            <ul class="treeview-menu" style="{{ (request()->segment(2) == 'products') ? 'display:block' : '' }}">
                <li><a href="{{ url('/administration/products') }}"><i class="fa fa-circle-o"></i> Product List</a></li>
                <li><a href="{{ url('/administration/products/create') }}"><i class="fa fa-circle-o"></i> Add Product</a></li>
            </ul>
        </li>

        <li class="treeview {{ (request()->segment(2) == 'deliveries') ? 'menu-open' : '' }}">
            <a href="#">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                <span>Delivery</span>
                <span class="pull-right-container">
            </span>
            </a>
            <ul class="treeview-menu" style="{{ (request()->segment(2) == 'deliveries') ? 'display:block' : '' }}">
                <li><a href="{{ url('/administration/deliveries') }}"><i class="fa fa-circle-o"></i> Delivery List</a></li>
                <li><a href="{{ url('/administration/deliveries/create') }}"><i class="fa fa-circle-o"></i> Add Delivery</a></li>
            </ul>
        </li>

        <li class="treeview {{ (request()->segment(2) == 'faqs') ? 'menu-open' : '' }}">
            <a href="#">
                <i class="fa fa-question-circle" aria-hidden="true"></i>
                <span>FAQ</span>
                <span class="pull-right-container">
            </span>
            </a>
            <ul class="treeview-menu" style="{{ (request()->segment(2) == 'faqs') ? 'display:block' : '' }}">
                <li><a href="{{ url('/administration/faqs') }}"><i class="fa fa-circle-o"></i> FAQ List</a></li>
                <li><a href="{{ url('/administration/faqs/create') }}"><i class="fa fa-circle-o"></i> Add FAQ</a></li>
            </ul>
        </li>

        <li class="treeview {{ (request()->segment(2) == 'orders') ? 'menu-open' : '' }}">
            <a href="#">
                <i class="fa fa-first-order" aria-hidden="true"></i>
                <span>Orders</span>
                <span class="pull-right-container">
            </span>
            </a>
            <ul class="treeview-menu" style="{{ (request()->segment(2) == 'orders') ? 'display:block' : '' }}">
                <li><a href="{{ url('/administration/orders') }}"><i class="fa fa-circle-o"></i> Order List</a></li>
{{--                <li><a href="{{ url('/administration/orders/economic/orders/create') }}"><i class="fa fa-circle-o"></i>Economic create order</a></li>--}}
{{--                <li><a href="{{ url('/administration/orders/economic/orders') }}"><i class="fa fa-circle-o"></i>Economic order list</a></li>--}}
            </ul>
        </li>

{{--        <li class="treeview {{ (request()->segment(2) == 'pakkelabels') ? 'menu-open' : '' }}">--}}
{{--            <a href="#">--}}
{{--                <i class="fa fa-shopping-cart" aria-hidden="true"></i>--}}
{{--                <span>Pakkelabels</span>--}}
{{--                <span class="pull-right-container">--}}
{{--            </span>--}}
{{--            </a>--}}
{{--            <ul class="treeview-menu" style="{{ (request()->segment(2) == 'pakkelabels') ? 'display:block' : '' }}">--}}
{{--                <li><a href="{{ url('/administration/pakkelabels') }}"><i class="fa fa-circle-o"></i>Create shipments</a></li>--}}
{{--                <li><a href="{{ url('/administration/pakkelabels/sales/orders') }}"><i class="fa fa-circle-o"></i>Get sales orders</a></li>--}}
{{--                <li><a href="{{ url('/administration/pakkelabels/shipments/list') }}"><i class="fa fa-circle-o"></i>Shipments List</a></li>--}}
{{--            </ul>--}}
{{--        </li>--}}

{{--        <li class="treeview {{ (request()->segment(2) == 'e-conomics') ? 'menu-open' : '' }}">--}}
{{--            <a href="#">--}}
{{--                <i class="fa fa-tasks" aria-hidden="true"></i>--}}
{{--                <span>E-conomics</span>--}}
{{--                <span class="pull-right-container">--}}
{{--            </span>--}}
{{--            </a>--}}
{{--            <ul class="treeview-menu" style="{{ (request()->segment(2) == 'e-conomics' || request()->segment(2) == 'economics') ? 'display:block' : '' }}">--}}
{{--                <li><a href="{{ url('/administration/economics/customers') }}"><i class="fa fa-circle-o"></i>Customers</a></li>--}}
{{--                <li><a href="{{ url('/administration/e-conomics') }}"><i class="fa fa-circle-o"></i>Export orders to invoice</a></li>--}}
{{--            </ul>--}}
{{--        </li>--}}

        <li class="treeview {{ (request()->segment(2) == 'invoices') ? 'menu-open' : '' }}">
            <a href="#">
                <i class="fa fa-tasks" aria-hidden="true"></i>
                <span>Invoice</span>
                <span class="pull-right-container">
            </span>
            </a>
            <ul class="treeview-menu" style="{{ (request()->segment(2) == 'invoices') ? 'display:block' : '' }}">
                <li><a href="{{ url('/administration/invoices') }}"><i class="fa fa-circle-o"></i>Invoice List</a></li>
                <li><a href="{{ url('/administration/invoices/create') }}"><i class="fa fa-circle-o"></i>Create Invoice</a></li>
            </ul>
        </li>

        <li class="treeview {{ (request()->segment(2) == 'packages') ? 'menu-open' : '' }}">
            <a href="#">
                <i class="fa fa-tasks" aria-hidden="true"></i>
                <span>Package delivery</span>
                <span class="pull-right-container">
            </span>
            </a>
            <ul class="treeview-menu" style="{{ (request()->segment(2) == 'packages') ? 'display:block' : '' }}">
                <li><a href="{{ url('/administration/packages') }}"><i class="fa fa-circle-o"></i>Package delivery list</a></li>
                <li><a href="{{ url('/administration/packages/create') }}"><i class="fa fa-circle-o"></i>Create package delivery</a></li>
            </ul>
        </li>

    </ul>
</section>

@endsection