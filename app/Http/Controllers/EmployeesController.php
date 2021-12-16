<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employees::all();

        return view('employees.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'company' => 'nullable',
            'email'    => 'nullable | email',
            'phone' => 'nullable'
        ]);
        
        $array = $request->only([
            'firstname', 'lastname', 'company', 'email', 'phone'
        ]);
        
        $employees = Employees::create($array);
        
        return redirect()->route('employees.index')
            ->with('success_message', 'Add new employee success!.');
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
        $employees = Employees::find($id);
        if (!$employees) return redirect()->route('employees.index')
            ->with('error_message', 'Employee with id'.$id.' not found');
        return view('employees.edit', [
            'employees' => $employees
        ]);
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
        $request->validate([
            'firsname' => 'required',
            'lastname' => 'required',
            'company' => 'nullable | numeric',
            'email'    => 'nullable | email',
            'phone' => 'nullable'
        ]);

        $employees = Employees::find($id);
        $employees->firstname = $request->firstname;
        $employees->lastname = $request->lastname;
        $employees->company = $request->company;
        $employees->email = $request->email;
        $employees->phone = $request->phone;
        
        $employees->save();
        return redirect()->route('employees.index')
            ->with('success_message', 'Update Employee success.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employees = Employees::find($id);

        if ($employees) $employees->delete();
        
        return redirect()->route('employees.index')
            ->with('success_message', 'Delete Employee Success');
    }
}
