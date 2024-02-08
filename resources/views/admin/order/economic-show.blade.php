@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Order info
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Order info</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <p>{{ $order['date'] }}</p>
                    </div>

                    <div class="form-group">
                        <label for="dueDate">Due Date:</label>
                        <p>{{ $order['dueDate'] }}</p>
                    </div>

                    <div class="form-group">
                        <label for="currency">Currency:</label>
                        <p>{{ $order['currency'] }}</p>
                    </div>

                    <div class="form-group">
                        <label for="exchangeRate">Exchange Rate:</label>
                        <p>{{ $order['exchangeRate'] }}</p>
                    </div>

                    <div class="form-group">
                        <label for="netAmount">Net Amount:</label>
                        <p>{{ $order['netAmount'] }}</p>
                    </div>

                    <div class="form-group">
                        <label for="vatAmount">Vat Amount:</label>
                        <p>{{ $order['vatAmount'] }}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="customer">Customer:</label>
                        <p>Customer Number: {{ $order['customer']['customerNumber'] }}</p>
                    </div>

                    @isset($order['recipient'])
                        <div class="form-group">
                            <label for="recipient">Recipient:</label>
                            <p>Recipient Name: {{ $order['recipient']['name'] }}</p>
                            <p>Recipient Address: {{ isset($order['recipient']['address']) ? $order['recipient']['address'] : '' }}</p>
                            <p>Recipient City: {{ isset($order['recipient']['city']) ? $order['recipient']['city'] : '' }}</p>
                            <p>Recipient Zip: {{ isset($order['recipient']['zip']) ? $order['recipient']['zip'] : '' }}</p>
                        </div>
                    @endisset

                    @isset($order['lines'])
                        <div class="form-group">
                            <label for="lines">Lines:</label>
                            @isset($order['lines'])
                                @foreach($order['lines'] as $line)
                                    <p>Lines Number: {{ $line['lineNumber'] }}</p>
                                    <p>Lines Product Number: {{ $line['product']['productNumber'] }}</p>
                                @endforeach
                            @endisset
                        </div>
                    @endisset

                </div>

            </div>
        </section>
    </div>

@endsection

