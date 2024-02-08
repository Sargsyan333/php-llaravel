@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Invoice
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Invoice</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Invoice Table</h3>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped faqs-table">
                                        <thead>
                                        <tr>
                                            <th>Draft Invoice Number</th>
                                            <th>Currency</th>
                                            <th>Due Date</th>
                                            <th>Created At</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($result as $invoice)
                                                <tr>
                                                    <td>
                                                        <a href="{{ url('administration/invoices/'.$invoice['draftInvoiceNumber']) }}">{{ $invoice['draftInvoiceNumber'] }}</a>
                                                    </td>
                                                    <td>{{ $invoice['currency'] }}</td>
                                                    <td>{{ $invoice['dueDate'] }}</td>
                                                    <td>{{ $invoice['date'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Draft Invoice Number</th>
                                            <th>Currency</th>
                                            <th>Due Date</th>
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
        </section>
    </div>


@endsection

