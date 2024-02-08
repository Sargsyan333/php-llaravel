@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Update Delivery
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Update Delivery</li>
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


                    <form action="{{ url("/administration/deliveries/$delivery->id")}}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Date picker</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Date:</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="delivery_date" class="form-control pull-right" value="{{ $delivery->delivery_date }}" id="datepicker" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-default">Submit</button>

                        </div>

                    </form>
                </div>
            </div>
        </section>

    </div>

@endsection

