<?php

namespace App\Http\Controllers;

use App\Models\Shopping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shopping = Shopping::all();

        return response()->json($shopping);
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
        $validator = Validator::make($request->all(),[
            'name' => 'required'
        ]);

        $shopping = Shopping::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'created_at' => $shopping->created_at,
            'id' => $shopping->id,
            'name' => $shopping->name,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shopping = Shopping::find($id);

        return response()->json($shopping);
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
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        $shopping = Shopping::find($id);
        $shopping->name = $request->name;
        $shopping->update();

        return response()->json([
            'created_at' => $shopping->created_at,
            'name' => $shopping->name,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shopping = Shopping::find($id);
        $shopping->delete();

        return response()->json('Sukses Delete Data!');
    }
}
