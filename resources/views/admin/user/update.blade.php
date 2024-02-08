@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Update User
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Update User</li>
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

                    <form action="{{ url("/administration/users/$user->id")}}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" value="{{ $user->name }}" name="name" required>
                            <input type="hidden" class="form-control" value="{{ $user->id }}" name="id">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" value="{{ $user->email }}" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="tel">Tel:</label>
                            <input type="text" class="form-control" id="tel" placeholder="Enter tel" value="{{ $user->tel }}" name="tel">
                        </div>

                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" placeholder="Enter address" value="{{ $user->address }}" name="address">
                        </div>

                        <div class="form-group">
                            <label for="zip">Zip:</label>
                            <input type="text" class="form-control" id="zip" placeholder="Enter zip" value="{{ $user->zip }}" name="zip">
                        </div>

                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" class="form-control" id="city" placeholder="Enter city" value="{{ $user->city }}" name="city">
                        </div>

                        <div class="form-group">
                            <label for="customer_number">Customer number:</label>
                            <input type="number" class="form-control" id="customer_number" placeholder="Enter customer number" value="{{ $user->customer_number }}" name="customer_number">
                        </div>

                        <div class="form-group">
                            <label for="primary_contact">Primary contact:</label>
                            <input type="text" class="form-control" id="primary_contact" placeholder="Enter primary contact" value="{{ $user->primary_contact }}" name="primary_contact">
                        </div>

                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>

                    </form>
                </div>

            </div>
        </section>



    </div>

@endsection

