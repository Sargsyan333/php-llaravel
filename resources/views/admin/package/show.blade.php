@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Package delivery info
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Package delivery info</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="name">Information:</label>
                        <p>{{ $package->package_delivery_information }}</p>
                    </div>

                </div>
            </div>
        </section>
    </div>

@endsection

