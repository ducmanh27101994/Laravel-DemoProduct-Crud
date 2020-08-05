<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = DB::table('products')
            ->orderBy('id', 'desc')
            ->get();
        return view('listProduct',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('createProduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->color = $request->input('color');
        //upload image
        if ($request->hasFile('image')){
            $image = $request->file('image');
            $path = $image->store('images','public');
            $product->image = $path;
        }

        $product->save();

        Session::get('success',"Them san pham thanh cong");

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::findOrFail($id);
        return view('editProduct',compact('product',$product['id']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->color = $request->input('color');

        if ($request->hasFile('image')){
            $currentImg = $product->image;
            if ($currentImg){
                Storage::delete('/public/'.$currentImg);
            }
            $image = $request->file('image');
            $path = $image->store('images','public');
            $product->image = $path;
        }

        $product->save();

        Session::get('success','Update du san pham thanh cong');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::findOrFail($id);
        $product->delete();

        Session::get('success',"Xoa product thanh cong");

        return redirect()->route('products.index');
    }

    function search(Request $request){
        $products = Product::where('name','like','%'.$request->keyword.'%')
                                    ->get();
        return view('listProduct',compact('products'));
    }
}
