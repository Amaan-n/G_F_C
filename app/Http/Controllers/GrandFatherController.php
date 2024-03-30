<?php

namespace App\Http\Controllers;

use App\Models\grandFather;

use Illuminate\Http\Request;

class GrandFatherController extends Controller
{
    //
    public function index()
    {
        $details = GrandFather::orderBy('created_at', 'desc')->paginate(4);
        return view('grandfather', ['details' => $details]);
    }
    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ]);
        $data = GrandFather::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
        ]);
        $data->save();

        return response()->json(['success' => true, 'message' => 'Data saved successfully']);

    }
    public function edit(Request $request)
    {
        $request->validate([
            'edit_id' => 'required|exists:grand_fathers,id',
            'edit_name' => 'required',
            'edit_email' => 'required|email',
            'edit_age' => 'required|numeric',
        ]);

        $grandFather = GrandFather::findOrFail($request->edit_id);
        $grandFather->name = $request->edit_name;
        $grandFather->email = $request->edit_email;
        $grandFather->age = $request->edit_age;
        $grandFather->save();

        return response()->json(['success' => true, 'message' => 'Data updated successfully']);
    }
    //Deleting
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:grand_fathers,id',
        ]);

        $grandFather = GrandFather::findOrFail($request->id);
        $grandFather->delete();

        return response()->json(['success' => true, 'message' => 'Data deleted successfully']);
    }

}

