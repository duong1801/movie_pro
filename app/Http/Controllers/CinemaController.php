<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Cinema::paginate(10);
        return view('cinema.list',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cinema.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:5',
            'address'=>'required'
        ],[
            'name.required'=>'Name not required',
            'name.min'=>'Name must be :min characters',
            'address.required'=>'Address not required'
        ]);

        $status = Cinema::create($request->all());
        if ($status) {
            return redirect()->route('cinema.index')->with('message','Add successfully');
        }
        return redirect()->route('cinema.index')->with('message','Failed to add');
    }

    /**
     * Display the specified resource.
     */
    public function show(cinema $cinema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cinema $cinema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cinema $cinema)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cinema $cinema)
    {
        //
    }
}
