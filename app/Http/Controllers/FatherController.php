<?php

namespace App\Http\Controllers;

use App\Models\father;
use Illuminate\Http\Request;

class FatherController extends Controller
{
    //
    public function index()
    {
        $details = Father::orderBy('created_at', 'desc')->paginate(4);
        return view('father', ['details' => $details]);
    }

    public function add(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ]);

        $father = new Father();
        $father->name = $request->name;
        $father->email = $request->email;
        $father->age = $request->age;
        $father->grand_fathers_id = $request->grandfathername;

        try {
            $result = $father->save();

            if ($result) {
                return response()->json(['success' => true, 'message' => 'Data saved successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to save data']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function edit(Request $request)
    {
        $request->validate([
            'edit_id' => 'required',
            'edit_name' => 'required',
            'edit_email' => 'required|email',
            'edit_age' => 'required|numeric',
        ]);

        $father = Father::findOrFail($request->edit_id);
        $father->name = $request->edit_name;
        $father->email = $request->edit_email;
        $father->age = $request->edit_age;
        $father->grand_fathers_id = $request->edit_grandfathername;
        $father->save();

        return response()->json(['success' => true, 'message' => 'Data updated successfully']);
    }
    //Deleting
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $father = Father::findOrFail($request->id);
        $father->delete();

        return response()->json(['success' => true, 'message' => 'Data deleted successfully']);
    }

}
