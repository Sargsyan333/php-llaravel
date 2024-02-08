@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Add Product
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Add Product</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-6">

                    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea type="text" class="form-control" id="description" placeholder="Enter description" name="description" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="colli_size">Colli size:</label>
                            <input type="text" class="form-control" id="colli_size" placeholder="Enter colli size" name="colli_size" required>
                        </div>

                        <div class="form-group">
                            <label for="size">Size:</label>
                            <input type="text" class="form-control" id="size" placeholder="Enter size" name="size" required>
                        </div>

                        <div class="form-group">
                            <label for="model_text">Model text:</label>
                            <input type="text" class="form-control" id="model_text" placeholder="Enter model text" name="model_text" required>
                        </div>

                        <div class="form-group">
                            <label for="skeeis_item_number">Skeeis item number:</label>
                            <input type="text" class="form-control" id="skeeis_item_number" placeholder="Enter skeeis item number" name="skeeis_item_number" required>
                        </div>

                        <div class="form-group">
                            <label for="pharmacy_item_number">Pharmacy item number:</label>
                            <input type="text" class="form-control" id="pharmacy_item_number" placeholder="Enter pharmacy item number" name="pharmacy_item_number" required>
                        </div>

                        <div class="form-group">
                            <label for="type">Type:</label>
                            <input type="text" class="form-control" id="type" placeholder="Enter type" name="type" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" class="form-control-file" name="images[]" id="image" multiple="multiple" required>
                        </div>

                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" class="form-control input-type-number" id="price" placeholder="Enter price" name="price" required>
                        </div>

                        <div class="form-group">
                            <label for="weight">Weight:</label>
                            <input type="text" class="form-control input-type-number" id="weight" placeholder="Enter weight" name="weight" required>
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection

