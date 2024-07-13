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
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'district_id' => 'required|integer',
            'phone' => 'required|string|max:15',
            'gender' => 'required|string|max:10',
            'occupation' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'result' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $person = new Person();
        $person->name = $request->name;
        $person->dob = $request->dob;
        $person->district_id = $request->district_id;
        $person->phone = $request->phone;
        $person->gender = $request->gender;
        $person->occupation = $request->occupation;
        $person->education = $request->education;
        $person->result = $request->result;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $person->image = $imageName;
        }

        $person->save();

        return redirect()->back()->with('success', 'Person added successfully');
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
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'district_id' => 'required|integer',
            'phone' => 'required|string|max:15',
            'gender' => 'required|string|max:10',
            'occupation' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'result' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $person = Person::find($request->id);
        $person->name = $request->name;
        $person->dob = $request->dob;
        $person->district_id = $request->district_id;
        $person->phone = $request->phone;
        $person->gender = $request->gender;
        $person->occupation = $request->occupation;
        $person->education = $request->education;
        $person->result = $request->result;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $person->image = $imageName;
        }

        $person->save();

        return redirect()->back()->with('success', 'Person updated successfully');
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
