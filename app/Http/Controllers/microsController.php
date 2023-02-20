<?php

namespace App\Http\Controllers;

use App\Models\micro;
use Illuminate\Http\Request;

class microsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
                $micros = micro::all();
                return view('micros' , compact('micros'));
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
        //
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
                'type' => 'required',
                'numMicro' => 'required',
            ];

            $messages = [
                'name.required' => 'أسم الباص مطلوب',
                'type.required' => 'نوع الباص مطلوب',
                'numMicro.required' => 'رقم الباص مطلوب',
            ];
            $validated = $request->validate($rules, $messages);

            micro::create([
                'name' => $request->name,
                'type' => $request->type,
                'numMicro' => $request->numMicro,
            ]);
            session()->flash('Success', 'تم أضافة الباص بنجاح  ');
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
                'type' => 'required',
                'numMicro' => 'required',
            ];

            $messages = [
                'name.required' => 'أسم الباص مطلوب',
                'type.required' => 'نوع الباص مطلوب',
                'numMicro.required' => 'رقم الباص مطلوب',
            ];
            $validated = $request->validate($rules, $messages);
            $microUpdate = micro::findOrFail($request->id) ;

            $microUpdate->update([
                'name' => $request->name,
                'type' => $request->type,
                'numMicro' => $request->numMicro,
            ]);
            session()->flash('Success', 'تم تعديل الباص بنجاح  ');
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
            $micro= micro::findOrFail($request->id);
            $micro->delete();
            session()->flash('Delete', 'تم حذف الباص بنجاح  ');
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
