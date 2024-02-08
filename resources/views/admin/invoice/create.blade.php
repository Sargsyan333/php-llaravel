@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Add Invoice
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Add Invoice</li>
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

                    <form action="{{route('invoice.store')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="customers">Customers:</label>
                            <select class="form-control" id="customers" name="customer" required>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer['customerNumber'] }}">{{ $customer['customerNumber'] }} - {{$customer['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="products">Products:</label>
                            <select class="form-control" id="customers" name="product">
                                @foreach($products as $product)
                                    <option value="{{ $product['productNumber'] }}">{{ $product['productNumber'] }} - {{$product['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>

                </div>
            </div>
        </section>
    </div>

@endsection

