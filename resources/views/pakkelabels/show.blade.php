@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Shipments info
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Shipments info</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-6">

{{--                    <div class="form-group">--}}
{{--                        <label for="name">Name:</label>--}}
{{--                        <p>{{ $faq->name }}</p>--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <label for="text">Text:</label>--}}
{{--                        <p>{{ $faq->text }}</p>--}}
{{--                    </div>--}}

                </div>
            </div>
        </section>
    </div>

@endsection

