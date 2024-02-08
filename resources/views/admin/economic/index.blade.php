@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Economic
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Economic</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (Session::has('message'))
                                <div class="alert alert-success">{{ Session::get('message') }}</div>
                            @endif

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Economic customers Table</h3>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped faqs-table">
                                        <thead>
                                        <tr>
                                            <th>Customer Number</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Currency</th>
                                            <th>Import</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($customers as $customer)
                                            <tr>
                                                <td>{{ $customer['customerNumber'] }}</td>
                                                <td>{{ $customer['name'] }}</td>
                                                <td>{{ (array_key_exists('email',$customer)?$customer['email']:'') }}</td>
                                                <td>{{ $customer['currency'] }}</td>
                                                <td style="text-align: center">
                                                    @if($customer['customerExists'])
                                                        <p style="color: #a5a5a5;font-size: 13px;">Imported!</p>
                                                    @else
                                                        @if(array_key_exists('email',$customer) && $customer['email'])
                                                            <a style="text-align: center" href="{{ url("/administration/economics/customers/import/".$customer['customerNumber']) }}">
                                                                <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                                            </a>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Customer Number</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Currency</th>
                                            <th>Import</th>
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

