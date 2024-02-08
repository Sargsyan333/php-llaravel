@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')

    <style>
        .bg-red {
            width: 15px;
            height: 15px;
            display: block;
            border-radius: 50%;
            background: greenyellow;
        }

        .bg-green {
            width: 15px;
            height: 15px;
            display: block;
            border-radius: 50%;
            background: darkred;
        }
    </style>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Order
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Order</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Order Table</h3>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped order-table">
                                        <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Date</th>
                                            <th>Currency</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td><a href="{{ url('administration/orders/economic/orders/'.$order['orderNumber'].'') }}">{{ $order['orderNumber'] }}</a></td>
                                                <td>{{ $order['date'] }}</td>
                                                <td>{{ $order['currency'] }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Number</th>
                                            <th>Date</th>
                                            <th>Currency</th>
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

