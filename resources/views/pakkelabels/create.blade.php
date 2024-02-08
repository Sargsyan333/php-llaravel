@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Shipments
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Shipments</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <section class="content">
                    <div class="row">

                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Orders with Shipments Table</h3>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped faqs-table">
                                        <thead>
                                        <tr>
                                            <th>Delivery Date</th>
                                            <th>Count</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($ordersTrue as $order)
                                            <tr data-number="{{ $order->id }}">

                                                <td>
                                                    {{ date('d-m-Y', strtotime($order->delivery->delivery_date)) }}
                                                </td>
                                                <td>
                                                    {{ $order->total }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Delivery Date</th>
                                            <th>Count</th>
                                        </tr>
                                        </tfoot>
                                    </table>


                                    <a href="{{ url('administration/pakkelabels/create') }}" class="btn btn-success">Send to pakkelabels</a>
                                </div>
                            </div>
                        </div>


                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Orders with no Shipments Table</h3>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped faqs-table">
                                        <thead>
                                        <tr>
                                            <th>Delivery Date</th>
                                            <th>Count</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($ordersFalse as $order)
                                            <tr>
                                                <td>
                                                    {{ date('d-m-Y', strtotime($order->delivery->delivery_date)) }}
                                                </td>
                                                <td>
                                                    {{ $order->total }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Delivery Date</th>
                                            <th>Count</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </section>

    </div>

@endsection

