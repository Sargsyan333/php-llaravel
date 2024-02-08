@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                User info
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">User info</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-6">

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <p>{{ $user->name }}</p>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <p>{{ $user->email }}</p>
                        </div>

                        <div class="form-group">
                            <label for="tel">Tel:</label>
                            <p>{{$user->tel}}</p>
                        </div>

                        <div class="form-group">
                            <label for="tel">Address:</label>
                            <p>{{ $user->address }}</p>
                        </div>

                        <div class="form-group">
                            <label for="zip">Zip:</label>
                            <p>{{ $user->zip }}</p>
                        </div>

                        <div class="form-group">
                            <label for="city">City:</label>
                            <p>{{ $user->city }}</p>
                        </div>

                        <div class="form-group">
                            <label for="customer_number">Customer number:</label>
                            <p>{{ $user->customer_number }}</p>
                        </div>

                        <div class="form-group">
                            <label for="primary_contact">Primary contact:</label>
                            <p>{{ $user->primary_contact }}</p>
                        </div>
                </div>

            </div>
        </section>

    </div>

@endsection

