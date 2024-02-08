@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Delivery info
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Delivery info</li>
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

                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Date picker</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Date:</label>
                                    <p>{{ $delivery->delivery_date }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>

@endsection

