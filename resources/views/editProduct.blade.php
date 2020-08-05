@extends('core.menuHeader')
@section('content')

    <div class="container">
        <br>
        <form method="post" enctype="multipart/form-data" action="{{route('products.update',$product->id)}}">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" name="name" value="{{$product['name']}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Price</label>
                <input type="text" class="form-control" name="price" value="{{$product['price']}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Color</label>
                <input type="text" class="form-control" name="color" value="{{$product['color']}}">
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Example file input</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
@endsection
