@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Export orders to invoice
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Export orders to invoice</li>
            </ol>
        </section>

        <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif

                        <div class="row">
                            <div class="col-xs-12">
                                <p> Start:{{ $last_month_info['start'] }}</p>
                                <p> End:  {{ $last_month_info['end'] }}</p>
                                <p> Month: {{ $last_month_info['month']['number'] .' / '. $last_month_info['month']['name'] }}</p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('exportOrdersToInvoice') }}">
                            @csrf
                            <button class="btn btn-success">Export orders to invoice</button>
                        </form>
                        <br>


                        <div class="box">

                            <div class="box-header">
                                <h3 class="box-title">Order Table</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Delivery</th>
                                        <th>Exported</th>
                                        <th>Created At</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr data-number="{{ $order->id }}">
                                            <td><a href="{{ url('administration/orders/'. $order->id ) }}">{{ $order->name }}</a></td>
                                            <td>{{ Str::replaceFirst('.', ',', $order->products[0]->price) }}</td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($order->delivery->delivery_date)) }}
                                            </td>
                                            <th>
                                                @if($order->economic_status)
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                @else

                                                @endif
                                            </th>
                                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Delivery</th>
                                        <th>Exported</th>
                                        <th>Created At</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
        </section>
    </div>

@endsection

