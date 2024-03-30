<?php

namespace App\Http\Controllers;

use App\Models\child;

use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function index()
    {
        $details = Child::orderBy('created_at', 'desc')->paginate(4);
        return view("child", compact("details"));
    }
    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
            'fathername' => 'required', // Add validation for fathername
            'grandfathername' => 'required', // Add validation for grandfathername
        ]);

        try {
            $child = new Child();
            $child->name = $request->name;
            $child->email = $request->email;
            $child->age = $request->age;
            $child->fathers_id = $request->fathername;
            $child->grandfather_id = $request->grandfathername; // Assign grandfather_id directly
            $result = $child->save();

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

        $child = child::findOrFail($request->edit_id);
        $child->name = $request->edit_name;
        $child->email = $request->edit_email;
        $child->age = $request->edit_age;
        $child->fathers_id = $request->edit_fathername;
        $child->grandfather_id = $request->edit_grandfathername;
        $child->save();

        return response()->json(['success' => true, 'message' => 'Data updated successfully']);
    }
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $father = Child::findOrFail($request->id);
        $father->delete();

        return response()->json(['success' => true, 'message' => 'Data deleted successfully']);
    }

}
