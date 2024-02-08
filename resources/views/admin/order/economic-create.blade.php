@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Add order into e-conomic
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Add order into e-conomic </li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-6">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{route('orders.economic')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="recipient_name">Recipient name:</label>
                            <input type="text" class="form-control" id="recipient_name" placeholder="Enter recipient name" name="recipient_name" required />
                        </div>

                        <div class="form-group">
                            <label for="recipient_address">Recipient address:</label>
                            <input type="text" class="form-control" id="recipient_address" placeholder="Enter recipient address" name="recipient_address" required />
                        </div>

                        <div class="form-group">
                            <label for="layout">Layout:</label>
                            <select class="form-control" id="layout" name="layout">
                                @foreach($layouts as $layout)
                                    <option value="{{ $layout['layoutNumber'] }}">{{ $layout['layoutNumber'] }} - {{$layout['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="payment">Payment:</label>
                            <select class="form-control" id="payment" name="payment">
                                @foreach($payments as $payment)
                                    <option value="{{ $payment['paymentTermsNumber'] }}">{{ $payment['paymentTermsNumber'] }} - {{$payment['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="customers">Customers:</label>
                            <select class="form-control" id="customers" name="customer">
                                @foreach($customers as $customer)
                                    <option value="{{ $customer['customerNumber'] }}">{{ $customer['customerNumber'] }} - {{$customer['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="currency">Currency:</label>
                            <input type="text" class="form-control" id="currency" placeholder="Enter currency" name="currency" value="DKK" required />
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection

