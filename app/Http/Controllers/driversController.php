<?php

namespace App\Http\Controllers;

use App\Models\driver;
use Illuminate\Http\Request;

class driversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
                $drivers= driver::all();
                return view('drivers' , compact('drivers'));
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'nationality' => 'required',
            ];

            $messages = [
                'name.required' => 'أسم السائق مطلوب',
                'phone.required' => 'رقم السائق مطلوب',
                'address.required' => 'عنوان السائق مطلوب',
                'nationality.required' => 'جنسية السائق مطلوب',
            ];
            $validated = $request->validate($rules, $messages);

            driver::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'nationality' => $request->nationality,
            ]);
            session()->flash('Success', 'تم أضافة السائق بنجاح  ');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
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
        try {
            $rules = [
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'nationality' => 'required',
            ];

            $messages = [
                'name.required' => 'أسم السائق مطلوب',
                'phone.required' => 'رقم السائق مطلوب',
                'address.required' => 'عنوان السائق مطلوب',
                'nationality.required' => 'جنسية السائق مطلوب',
            ];
            $validated = $request->validate($rules, $messages);
            $driverUpdate = driver::findOrFail($request->id);

            $driverUpdate->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'nationality' => $request->nationality,
            ]);
            session()->flash('Success', 'تم تعديل السائق بنجاح  ');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

        public function destroy(Request $request)
    {
        try
        {
            $driver= driver::findOrFail($request->id);
            $driver->delete();
            session()->flash('Delete', 'تم حذف السائق بنجاح  ');
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
