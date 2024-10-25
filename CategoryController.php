<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

use function Termwind\parse;

class CategoryController extends Controller
{
    public function index()
    {
        #getting Data from database through Eloquent
        $employees = Employee::all();
        return view('admin.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.create');
    }

    

    public function store(Request $request)
    {
        // $validate = $request->validate([
        //     'employee_name' => 'required|unique:Employee|max:255',
        //     'email' => 'required|email'
        // ],
        // [
        //     'employee_name.required' => 'Employee name is mandatory',
        //     'employee_name.unique' => 'Employee name already exist',
        //     'employee_name.max' => 'Employee name should be lessthan 255 char.'
        // ]);


        

        #Entering Data in Database
        Employee::create([
            'user_id' => Auth::user()->id,
            'employee_name' => $request->employee_name,
            'email' => $request->email
        ]);

        return back()->with('message', 'Employee Added Successfully');

        // Employee::insert([
        //     'user_id' => Auth::user()->id,
        //     'employee_name' => $request->employee_name,
        //     'email' => $request->email
        // ]);

        // $employee = new Employee();
        // $employee->user_id = Auth::user()->id;
        // $employee->employee_name = $request->employee_name;
        // $employee->email = $request->email;
        // $employee->Save();

        // return redirect()->back()->with('message', 'Employee created successfully');
        // return back()->with('success','User added successfully');

        // Display a success toast with no title
        // flash()->success('Operation completed successfully.');
    
    }

    
    
}
