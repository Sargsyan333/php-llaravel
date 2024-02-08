@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                FAQ
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">FAQ</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">FAQ Table</h3>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped faqs-table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($faqs as $faq)
                                            <tr data-number="{{ $faq->id }}">
                                                <td><a href="{{ url('administration/faqs/'. $faq->id ) }}">{{ $faq->name }}</a></td>
                                                <td>{{ $faq->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    <a href="{{ url("/administration/faqs/$faq->id/edit") }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                </td>
                                                <td class="delete-items delete-faq-item" data-id="{{ $faq->id }}">
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

