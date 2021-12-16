<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Companies::all();

        return view('companies.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        $request->validate([
            'name' => 'required',
            'email'=> 'nullable | email',
            'logo'=> 'nullable | image | mimes:jpeg,png,jpg,gif | max:2048',
            'website'=> ['nullable', 'regex:'.$regex]
        ]);

        $array = $request->only([
            'name', 'email', 'logo', 'website'   
        ]);

        if ($logo = $request->file('logo')) {

            // $fileName = md5($logo->getClientOriginalName() . microtime()) . '.' . $logo->getClientOriginalExtension();

            $destinationPath = 'logo';

            $profileImage = date('YmdHis') . "." . $logo->getClientOriginalExtension();

            $logo->move(public_path($destinationPath), $profileImage);
            // $request->logo = "$profileImage";
            // dd($request, $request->logo, $array['name'], $profileImage);
            $array['logo'] = "$profileImage";

        }
        
        $companies = Companies::create($array);
        return redirect()->route('companies.index')
            ->with('success_message', 'Add new company success!.');
    
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
        $companies = Companies::find($id);
        if (!$companies) return redirect()->route('companies.index')
            ->with('error_message', 'Company with id'.$id.' not found');
        return view('companies.edit', [
            'companies' => $companies
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
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        $request->validate([
            'name' => 'required',
            'email'=> 'nullable | email',
            'logo'=> 'nullable | image |mimes:jpeg,png,jpg,gif|max:2048',
            'website'=> 'nullable | regex:'.$regex
        ]);

        $companies = Companies::find($id);
        $companies->name = $request->name;
        $companies->email = $request->email;
        $companies->logo = $request->logo;
        $companies->website = $request->website;
        
        $companies->save();
        return redirect()->route('companies.index')
            ->with('success_message', 'Update Company success.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companies = Companies::find($id);

        if ($companies) $companies->delete();
        
        return redirect()->route('companies.index')
            ->with('success_message', 'Delete Company Success');
    }
}
