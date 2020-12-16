<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Category;
use App\Flavor;
use App\Measurement;
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
        if (!Auth::user()->is_admin) {
            return redirect('/')->with('error', 'You need admin priviledges to perform this operation!');
        }

        $categories = Category::orderBy('name', 'asc')->get();
        return view('products.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->is_admin) {
            return redirect('/')->with('error', 'You need admin priviledges to perform this operation!');
        }
        // get all categories
        $categories = Category::all()->pluck('name', 'id')->toArray();
        $flavors = Flavor::all();
        $measurements = Measurement::all();
        return view('products.create')->with(compact('categories', 'flavors', 'measurements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->is_admin) {
            return redirect('/')->with('error', 'You need admin priviledges to perform this operation!');
        }

        $this->validate($request, [
            'name'=>'required',
            'price'=>'required',
            'desc'=>'required',
            'product_image'=>'image|required|max:1999',
            'category'=> 'required',
            'flavors' => 'nullable',
            'measurements' => 'nullable'
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

        $flavors = Flavor::find($request->input('flavors'));
        $product->flavors()->attach($flavors);

        $measurements = Measurement::find($request->input('measurements'));
        $product->measurements()->attach($measurements);


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
        if (!Auth::user()->is_admin) {
            return redirect('/')->with('error', 'You need admin priviledges to perform this operation!');
        }

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
        if (!Auth::user()->is_admin) {
            return redirect('/')->with('error', 'You need admin priviledges to perform this operation!');
        }

        $product=Product::find($id);
        $categories = Category::all()->pluck('name', 'id')->toArray();
        $flavors = Flavor::all();
        $measurements = Measurement::all();

        return view('products.edit')->with(compact('product', 'categories', 'flavors', 'measurements'));
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
        if (!Auth::user()->is_admin) {
            return redirect('/')->with('error', 'You need admin priviledges to perform this operation!');
        }

        $this->validate($request, [
            'name'=>'required',
            'price'=>'required',
            'desc'=>'required',
            'category' => 'required',
            'flavors' => 'nullable',
            'measurements' => 'nullable',
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

        // Detach and re-attach flavors
        $product->flavors()->detach($product->flavors->pluck('id')->toArray());
        $flavors = Flavor::find($request->input('flavors'));
        $product->flavors()->attach($flavors);

        // Detach and re-attach measurements
        $product->measurements()->detach($product->measurements->pluck('id')->toArray());
        $measurements = Measurement::find($request->input('measurements'));
        $product->measurements()->attach($measurements);

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
        if (!Auth::user()->is_admin) {
            return redirect('/')->with('error', 'You need admin priviledges to perform this operation!');
        }
        
        $product=Product::find($id);
        Storage::delete('public/product_images/'.$product->product_image);
        $product->delete();

        return redirect('/products')->with('success', 'Product deleted successfully');
    }
}
