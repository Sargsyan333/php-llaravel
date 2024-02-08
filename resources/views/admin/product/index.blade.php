@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Product
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Product</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Product Table</h3>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped product-table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Skee Number</th>
                                            <th>Created At</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr data-number="{{ $product->id }}">
                                                <td><a href="{{ url('administration/products/'. $product->id ) }}">{{ $product->name }}</a></td>
                                                <td>{{ Str::replaceFirst('.', ',', $product->price) }}</td>
                                                <td>{{ $product->skeeis_item_number }}</td>
                                                <td>{{ $product->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    <a href="{{ url("/administration/products/$product->id/edit") }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                </td>
                                                <td class="delete-items delete-product-item" data-id="{{ $product->id }}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Number</th>
                                            <th>Created At</th>
                                            <th>Edit</th>
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

