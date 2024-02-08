@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Sales
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Orders</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Orders Table</h3>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped product-table">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Order id</th>
                                            <th>Order status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($salesOrders['output'] as $r)
                                            <tr>
                                                <td>{{ $r['id'] }}</td>
                                                <td>{{ $r['order_id'] }}</td>
                                                <td>{{ $r['order_status'] }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Order id</th>
                                            <th>Order status</th>
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
