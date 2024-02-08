@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Package information
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Package information</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Package information Table</h3>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped package-table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($packages as $package)
                                            <tr data-number="{{ $package->id }}">
                                                <td><a href="{{ url('administration/packages/'. $package->id ) }}">{{ $package->package_delivery_information }}</a></td>
                                                <td>{{ $package->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    <a href="{{ url("/administration/packages/$package->id/edit") }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                </td>
                                                <td class="delete-items delete-package-item" data-id="{{ $package->id }}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Name</th>
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

