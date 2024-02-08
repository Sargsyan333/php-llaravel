@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Add Delivery
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Add Delivery</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">

                <form action="{{route('deliveries.store')}}" method="post">
                    @csrf

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
                                        <input type="text" name="delivery_date" class="form-control pull-right date" id="datepicker" placeholder="Pick the multiple dates" multiple autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </div>

@endsection

