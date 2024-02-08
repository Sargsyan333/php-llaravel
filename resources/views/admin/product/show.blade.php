@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Product info
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Product info</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <p>{{ $product->name }}</p>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <p>{{ $product->description }}</p>
                    </div>

                    <div class="form-group">
                        <label for="colli_size">Colli size:</label>
                        <p>{{ $product->colli_size }}</p>
                    </div>

                    <div class="form-group">
                        <label for="size">Size:</label>
                        <p>{{ $product->size }}</p>
                    </div>

                    <div class="form-group">
                        <label for="model_text">Model text:</label>
                        <p>{{ $product->model_text }}</p>
                    </div>

                    <div class="form-group">
                        <label for="skeeis_item_number">Skeeis item number:</label>
                        <p>{{ $product->skeeis_item_number }}</p>
                    </div>

                    <div class="form-group">
                        <label for="pharmacy_item_number">Pharmacy item number:</label>
                        <p>{{ $product->pharmacy_item_number }}</p>
                    </div>

                    <div class="form-group">
                        <label for="type">Type:</label>
                        <p>{{ $product->type }}</p>
                    </div>

                    <div class="form-group">
                        <label for="price">Price:</label>
                        <p>{{ $product->price }}</p>
                    </div>

                    <div class="form-group">
                        <label for="price">Weight:</label>
                        <p>{{ $product->weight }}</p>
                    </div>

                    <div class="form-group">
                        <label for="price">Images:</label>
                        <br>
                        @if($product->images)
                            @foreach($product->images as $image)
                                <img src="{{ '/storage/uploads/' . $image->filename }}" style="width: 120px" alt="">
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>
        </section>
    </div>

@endsection

