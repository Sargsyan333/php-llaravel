@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Packages delivery
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Update Packages delivery</li>
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

                    <form action="{{ url("/administration/packages/$package->id")}}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="package_delivery_information">Information:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter package delivery information" value="{{ $package->package_delivery_information }}" name="package_delivery_information" required>
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>

                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection

