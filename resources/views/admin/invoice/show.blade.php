@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Invoice info
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Invoice info</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <p>{{ $invoice['date'] }}</p>
                    </div>

                    <div class="form-group">
                        <label for="dueDate">Due Date:</label>
                        <p>{{ $invoice['dueDate'] }}</p>
                    </div>

                    <div class="form-group">
                        <label for="currency">Currency:</label>
                        <p>{{ $invoice['currency'] }}</p>
                    </div>

                    <div class="form-group">
                        <label for="exchangeRate">Exchange Rate:</label>
                        <p>{{ $invoice['exchangeRate'] }}</p>
                    </div>

                    <div class="form-group">
                        <label for="netAmount">Net Amount:</label>
                        <p>{{ $invoice['netAmount'] }}</p>
                    </div>

                    <div class="form-group">
                        <label for="vatAmount">Vat Amount:</label>
                        <p>{{ $invoice['vatAmount'] }}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="customer">Customer:</label>
                        <p>Customer Number: {{ $invoice['customer']['customerNumber'] }}</p>
                    </div>

                    <div class="form-group">
                        <label for="recipient">Recipient:</label>
                        <p>Recipient Name: {{ $invoice['recipient']['name'] }}</p>
                        <p>Recipient Address: {{ isset($invoice['recipient']['address']) ? $invoice['recipient']['address'] : '' }}</p>
                        <p>Recipient City: {{ isset($invoice['recipient']['city']) ? $invoice['recipient']['city'] : '' }}</p>
                    </div>

                    <div class="form-group">
                        <label for="lines">Lines:</label>
                        @isset($invoice['lines'])
                            @foreach($invoice['lines'] as $line)
                                <p>Lines Number: {{ $line['lineNumber'] }}</p>
                                <p>Lines Product Number: {{ $line['product']['productNumber'] }}</p>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection





