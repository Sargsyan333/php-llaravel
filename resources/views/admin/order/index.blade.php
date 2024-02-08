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
                                            <th>Order Id</th>
                                            <th>Name</th>
                                            <th>Economic Id</th>
                                            <th>Delivery</th>
                                            <th>Shipmondo</th>
                                            <th>Created At</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                            <tr data-number="{{ $order->id }}">
                                                <td><a href="{{ url('administration/orders/'. $order->id ) }}">{{ $order->id }}</a></td>
                                                <td>{{ optional($order->user)->name }}</td>
                                                <td>{{ $order->economics_id }}</td>
                                                <td>
                                                    {{ date('d-m-Y', strtotime(optional($order->delivery)->delivery_date)) }}
                                                </td>
                                                <td>
                                                    @if($order->shipmondo_id)
{{--                                                        <a href="{{ url('administration/pakkelabels/shipments/'.$order->shipmondo_id) }}" style="height: 15px;width: 15px;display: inline-block;">--}}
                                                        <a style="height: 15px;width: 15px;display: inline-block;">
                                                            <span class="bg-green"></span>
                                                        </a>
                                                        <span>{{$order->shipmondo_id}}</span>
                                                    @else
                                                        <span class="bg-red"></span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->created_at->format('d-m-Y') }}</td>

                                                <td class="delete-items delete-order-item" data-id="{{ $order->id }}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Order Id</th>
                                            <th>Name</th>
                                            <th>Economic Id</th>
                                            <th>Delivery</th>
                                            <th>Shipmondo</th>
                                            <th>Created At</th>
                                            <th>Delete</th>
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

