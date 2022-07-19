<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class resturantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rest = Restaurant::all();
        return $rest;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createres');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'domain' => ['required','unique:restaurants,domain'],
        ]);
        if ($validator->fails()) {
            return Response()->json($validator->getMessageBag(), 400);
        }
        $restaurant = Restaurant::create([
            'name' => $request->name,
            'domain' => $request->domain,
        ]);

        return Response()->json('Restaurant stored', 201);
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
       $res = Restaurant::find($id);
        return view('editres',compact('res'));
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'domain' => ['required','unique:restaurants,domain'],
        ]);
        if ($validator->fails()) {
            return Response()->json($validator->getMessageBag(), 400);
        }
        $restaurant = Restaurant::find($id);
        $restaurant->update([
            'name' => $request->name,
            'domain' => $request->domain,
        ]);

        return Response()->json('Restaurant update', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Restaurant::find($id);
        $res->delete();
        return redirect()->back();
    }
}
