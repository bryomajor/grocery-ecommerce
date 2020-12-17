<?php

namespace App\Http\Controllers;

use App\Measurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function is_admin()
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('shop')->with('error', 'You need admin rights to perform this operation')->throwResponse();
        }
    }

    public function index()
    {
        $this->is_admin();
        $measurements = Measurement::orderBy('created_at', 'desc')->get();
        return view('admin.measurements.index')->with('measurements', $measurements);
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
        $this->is_admin();
        $this->validate($request, [
            'name' => 'required'
        ]);

        $measurement = new Measurement;
        $measurement->name = $request->input('name');
        $measurement->save();

        return redirect('/measurements')->with('success', 'Measurement unit added successfully!');
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
        $this->is_admin();
        $measurement = Measurement::find($id);
        return view('admin.measurements.edit')->with('measurement', $measurement);
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
        $this->is_admin();
        $measurement = Measurement::find($id);
        $measurement->name = $request->input('name');
        $measurement->save();

        return redirect('/measurements')->with('success', 'Measurement unit updated succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->is_admin();
        $measurement = Measurement::find($id);
        $measurement->delete();

        return redirect('/measurements')->with('success', 'Measurement unit deleted!');
    }
}
