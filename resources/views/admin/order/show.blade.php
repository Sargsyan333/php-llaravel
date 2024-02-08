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
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <p>{{ $order->name }}</p>
                    </div>

                    <div class="form-group">
                        <label for="description">Delivery:</label>
                        <p>{{ $order->delivery->delivery_date }}</p>
                    </div>

                    <div class="form-group">
                        <label for="model_text">Email:</label>
                        <p>{{ $order->email }}</p>
                    </div>

                    <div class="form-group">
                        <label for="colli_size">User:</label>
                        <p>{{ $order->user->name }}</p>
                        <p>{{ $order->user->email }}</p>
                    </div>

                    <div class="form-group">
                        <label for="skeeis_item_number">Mobile:</label>
                        <p>{{ $order->mobile }}</p>
                    </div>

                    <div class="form-group">
                        <label for="pharmacy_item_number">Address:</label>
                        <p>{{ $order->address }}</p>
                    </div>

                </div>

                <div class="col-md-6">

                    @php
                        $total_price = 0;
                        $total_amount = 0;
                    @endphp

                    <div class="form-group">
                        <label for="description">Delivery:</label>
                        <p>{{ $order->delivery->delivery_date }}</p>
                    </div>

                    <div class="form-group">
                        <label for="name">Products:</label>
                        @foreach($order->products as $product)

                            <p>Name: <a href="{{ url('administration/products/'. $product->id ) }}">{{ $product->name }}</a></p>

                            @php
                                $total_price = $total_price + $product->pivot->price;
                                $total_amount = $total_amount + $product->pivot->amount;
                            @endphp

                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="pharmacy_item_number">Total amount:</label>
                        <p>{{ $total_amount }}</p>
                    </div>

                    <div class="form-group">
                        <label for="pharmacy_item_number">Total price:</label>
                        <p>{{ $total_price }}</p>
                    </div>

                </div>
                
            </div>
        </section>
    </div>

@endsection

