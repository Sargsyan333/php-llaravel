@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Add FAQ
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Add FAQ</li>
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

                    <form action="{{route('faqs.store')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="text">Text:</label>
                            <textarea type="text" class="form-control" id="text" placeholder="Enter text" name="text" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection

