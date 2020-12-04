<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Category;
use App\User;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        $categories = Category::orderBy('name', 'asc')->get();
        return view('products.index')->with(compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get all categories
        $categories = Category::all()->pluck('name', 'id')->toArray();
        return view('products.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'price'=>'required',
            'desc'=>'required',
            'product_image'=>'image|required|max:1999',
            'category'=>'nullable'
        ]);

        // handle file upload
        if($request->hasFile('product_image')){
            //get file name with extension
            $filenameWithExt=$request->file('product_image')->getClientOriginalName();
            //get just file name
            $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extention
            $extension=$request->file('product_image')->getClientOriginalExtension();
            //file name to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //upload image
            $path=$request->file('product_image')->storeAs('public/product_images', $fileNameToStore);
        }

        $product=new Product;
        $product->name=$request->input('name');
        $product->price=$request->input('price');
        $product->desc=$request->input('desc');
        $product->product_image=$fileNameToStore;
        $product->category_id = $request->input('category');
        $product->save();

        return redirect('/products')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $product=Product::find($id);
       return view('products.show')->with(compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        $categories = Category::all()->pluck('name', 'id')->toArray();
        return view('products.edit')->with(compact('product','categories'));
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
        $this->validate($request, [
            'name'=>'required',
            'price'=>'required',
            'desc'=>'required',
            'category' => 'required',
            'product_image'=>'image|nullable|max:1999'
        ]);


        // handle file upload
        if($request->hasFile('product_image')){
            //get file name with extension
            $filenameWithExt=$request->file('product_image')->getClientOriginalName();
            //get just file name
            $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extention
            $extension=$request->file('product_image')->getClientOriginalExtension();
            //file name to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //upload image
            $path=$request->file('product_image')->storeAs('public/product_images', $fileNameToStore);
        }

        $product=Product::find($id);
        $product->name=$request->input('name');
        $product->price=$request->input('price');
        $product->desc=$request->input('desc');
        $product->category_id = $request->input('category');

        if($request->hasFile('product_image')){
            $product->product_image=$fileNameToStore;
        }
        $product->save();

        return redirect('/products')->with('success', 'Product edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        Storage::delete('public/product_images/'.$product->product_image);
        $product->delete();

        return redirect('/products')->with('success', 'Product deleted successfully');
    }
}
