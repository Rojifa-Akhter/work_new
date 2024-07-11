<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\District;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Person::with('district')->get();
        $districts = District::all(); // Fetch all districts

        return view('admin.person.table', compact('data', 'districts'));
    }


    public function add()
    {
        $district = District::all();
        return view('admin.person.form', compact('district'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'dob' => 'required',
            'district_id' => 'required|exists:districts,id',
            'phone' => 'required',
            'gender' => 'required',
            'occupation' => 'required',
            'education' => 'required',
            'result' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'dob' => $request->dob,
            'district_id' => $request->district_id,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'occupation' => $request->occupation,
            'education' => $request->education,
            'result' => $request->result,
        ];

        Person::create($data); // Use create instead of insert for mass assignment

        return redirect()->route('admin.person.table')->with('message', 'Added successfully!');
    }
    public function edit($id)
    {
        $data = Person::findOrFail($id);
        $districts = District::all();

        return view('admin.person.editForm', compact('data', 'districts'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'dob' => 'required',
            'district_id' => 'required|exists:districts,id',
            'phone' => 'required',
            'gender' => 'required',
            'occupation' => 'required',
            'education' => 'required',
            'result' => 'required',
        ]);
    
        $data = Person::findOrFail($request->id);
        $data->name = $request->name;
        $data->dob = $request->dob;
        $data->district_id = $request->district_id;
        $data->phone = $request->phone;
        $data->gender = $request->gender;
        $data->occupation = $request->occupation;
        $data->education = $request->education;
        $data->result = $request->result;
        $data->save();
    
        return redirect()->route('admin.person.table')->with('success', 'Updated successfully.');
    }
    

    public function destroy($id)
    {
        try {
            Person::findOrFail($id)->delete();
            return redirect()->route('admin.person.table')->with('success', 'person deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.person.table')->with('error', 'person to delete ');
        }
    }
}
