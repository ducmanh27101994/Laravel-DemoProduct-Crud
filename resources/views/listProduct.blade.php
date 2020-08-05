
@extends('core.menuHeader')

@section('content')

    <br>
    <div class="container">
        <a href="{{route('products.create')}}" class="btn btn-success">Add Product</a>
        @if(\Illuminate\Support\Facades\Session::has('success'))
            {{\Illuminate\Support\Facades\Session::get('success')}}
        @endif
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Color</th>
            <th scope="col">Image</th>
            <th scope="col" colspan="2">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(empty($products))
            <tr>
                <td>No data</td>
            </tr>
        @else
        @foreach($products as $key => $product)
            <tr>
                <td>{{++$key}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->color}}</td>
                <td><img style="width: 55px; height: 70px" src="{{ asset('storage/'.$product->image) }}"></td>
                <td><a href="{{route('products.edit',$product->id)}}">Edit</a></td>
                <td><a onclick="return confirm('Are you sure')" href="{{route('products.delete',$product->id)}}">Delete</a> </td>
            </tr>

        @endforeach
        @endif
        </tbody>
    </table>

    </div>

@endsection

