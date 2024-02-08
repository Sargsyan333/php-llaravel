@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Update Product
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Update Product</li>
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

                    <form action="{{ url("/administration/products/$product->id")}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" value="{{ $product->name }}" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea type="text" class="form-control" id="description" placeholder="Enter description" name="description" required>{{ $product->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="colli_size">Colli size:</label>
                            <input type="text" class="form-control" id="colli_size" placeholder="Enter colli size" value="{{ $product->colli_size }}" name="colli_size" required>
                        </div>

                        <div class="form-group">
                            <label for="size">Size:</label>
                            <input type="text" class="form-control" id="size" placeholder="Enter size" value="{{ $product->size }}" name="size" required>
                        </div>

                        <div class="form-group">
                            <label for="model_text">Model text:</label>
                            <input type="text" class="form-control" id="model_text" placeholder="Enter model text" value="{{ $product->model_text }}" name="model_text" required>
                        </div>

                        <div class="form-group">
                            <label for="skeeis_item_number">Skeeis item number:</label>
                            <input type="text" class="form-control" id="skeeis_item_number" placeholder="Enter skeeis item number" value="{{ $product->skeeis_item_number }}" name="skeeis_item_number"  required>
                        </div>

                        <div class="form-group">
                            <label for="pharmacy_item_number">Pharmacy item number:</label>
                            <input type="text" class="form-control" id="pharmacy_item_number" placeholder="Enter pharmacy item number" value="{{ $product->pharmacy_item_number }}" name="pharmacy_item_number" required>
                        </div>

                        <div class="form-group">
                            <label for="type">Type:</label>
                            <input type="text" class="form-control" id="type" placeholder="Enter type" value="{{ $product->type }}" name="type" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Image:</label>

                            <div class="images_prodcu">
                                @if($product->images)
                                    @foreach($product->images as $image)
                                        <div class="image-container">
                                            <img src="{{ '/storage/uploads/' . $image->filename }}" style="width: 100%" alt="">
                                            <input type="hidden" name="current_images[]" value="{{ $image->id }}">
                                            <p class="remove_image_item">x</p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <br>
                            <input type="file" class="form-control-file" name="images[]" id="image" multiple="multiple">
                        </div>

                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" class="form-control input-type-number" id="price" value="{{ Str::replaceFirst('.', ',', $product->price) }}" placeholder="Enter price" name="price" required>
                        </div>

                        <div class="form-group">
                            <label for="weight">Weight:</label>
                            <input type="text" class="form-control input-type-number" id="weight" value="{{ Str::replaceFirst('.', ',', $product->weight) }}" placeholder="Enter weight" name="weight" required>
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection

