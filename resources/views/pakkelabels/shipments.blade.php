@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Shipments
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Shipments</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Shipments Table</h3>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped order-table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Created at</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($shipments as $shipment)
                                                <tr>
                                                    <td>Item</td>
                                                    <td>Created at</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
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

