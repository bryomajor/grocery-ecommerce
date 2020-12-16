<?php

namespace App\Http\Controllers;

use App\Flavor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlavorController extends Controller
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

        $flavors = Flavor::all();
        return view('flavors.index')->with('flavors', $flavors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required'
        ]);

        $flavor = new Flavor;
        $flavor->name = $request->input('name');
        $flavor->save();

        return redirect('/flavors')->with('success', 'Flavor created successfully!');
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
        if (!Auth::user()->is_admin) {
            return redirect('/')->with('error', 'You need admin priviledges to perform this operation!');
        }

        $flavor = Flavor::find($id);
        return view('flavors.edit')->with('flavor', $flavor);
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
            'name' => 'required'
        ]);

        $flavor = Flavor::find($id);
        $flavor->name = $request->input('name');
        $flavor->save();

        return redirect('/flavors')->with('success', 'Flavor edited successfully!');
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
        
        $flavor = Flavor::find($id);
        $flavor->delete();

        return redirect('/flavors')->with('success', 'Flavor deleted successfully!');
    }
}
