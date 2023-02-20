<?php

namespace App\Http\Controllers;

use App\Models\driver;
use App\Models\micro;
use App\Models\trip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TripsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $trips = trip::orderByDesc('dateTrip')->get();
            $micros = micro::all();
            $drivers = driver::all();
            return view('home', compact('micros', 'drivers', 'trips'));
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
                'dateTrip' => 'required|date|after:today',
                'from' => 'required',
                'to' => 'required',
                'micro_id' => 'required',
                'driver_id' => 'required',
                'driver_id2' => 'different:driver_id',
                'numPeople' => 'required',
                'notes' => 'max:255',
            ];

            $messages = [
                'dateTrip.required' => 'تاريخ الرحلة مطلوب',
                'dateTrip.date' => 'تاريخ الرحلة يجب ان يكون من نمط التاريخ ',
                'dateTrip.after' => 'يجب ان يكون تاريخ الرحلة بعد تاريخ اليوم',
                'from.required' => 'مكان انطلاق الرحلة مطلوب',
                'to.required' => 'مكان توجه الرحلة مطلوب',
                'micro_id.required' => 'الباص الناقل مطلوب',
                'driver_id.required' => 'السائق مطلوب',
                'driver_id2.different' => 'لا يمكن ان يكون السائق هو نفسه المرافق',
                'numPeople.required' => 'الحد لاأقصى للركاب مطلوب',
                'notes.max' => 'الكلمات كثيرة في خانة الملاحظات الرجاء تقليل الكلمات',
            ];
            $validated = $request->validate($rules, $messages);

            trip::create([
                'dateTrip' => $request->dateTrip,
                'from' => $request->from,
                'to' => $request->to,
                'micro_id' => $request->micro_id,
                'driver_id' => $request->driver_id,
                'driver_id2' => $request->driver_id2,
                'numPeople' => $request->numPeople,
                'feels' => $request->feels,
                'notes' => $request->notes,
            ]);

            $trips = trip::orderByDesc('id')->get();
            $micros = micro::all();
            $drivers = driver::all();
            toast('تم أضافة رحلة جديدة بنجاح', 'success');
            return view('home', compact('micros', 'drivers', 'trips'));
        }
        catch (\Exception $e)
        {
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
                'dateTrip' => 'required|date|after:today',
                'from' => 'required',
                'to' => 'required',
                'micro_id' => 'required',
                'driver_id' => 'required',
                'driver_id2' => 'different:driver_id',
                'numPeople' => 'required',
                'notes' => 'max:255',
            ];

            $messages = [
                'dateTrip.required' => 'تاريخ الرحلة مطلوب',
                'dateTrip.date' => 'تاريخ الرحلة يجب ان يكون من نمط التاريخ ',
                'dateTrip.after' => 'يجب ان يكون تاريخ الرحلة بعد تاريخ اليوم',
                'from.required' => 'مكان انطلاق الرحلة مطلوب',
                'to.required' => 'مكان توجه الرحلة مطلوب',
                'micro_id.required' => 'الباص الناقل مطلوب',
                'driver_id.required' => 'السائق مطلوب',
                'driver_id2.different' => 'لا يمكن ان يكون السائق هو نفسه المرافق',
                'numPeople.required' => 'الحد لاأقصى للركاب مطلوب',
                'notes.max' => 'الكلمات كثيرة في خانة الملاحظات الرجاء تقليل الكلمات',
            ];
            $validated = $request->validate($rules, $messages);
            $trip = trip::findOrFail($request->id);
            $trip->update([
                'dateTrip' => $request->dateTrip,
                'from' => $request->from,
                'to' => $request->to,
                'micro_id' => $request->micro_id,
                'driver_id' => $request->driver_id,
                'driver_id2' => $request->driver_id2,
                'numPeople' => $request->numPeople,
                'feels' => $request->feels,
                'notes' => $request->notes,
            ]);

            $trips = trip::orderByDesc('id')->get();
            $micros = micro::all();
            $drivers = driver::all();
            toast('تم تعديل الرحلة بنجاح', 'success');
            return view('home', compact('micros', 'drivers', 'trips'));
        }
        catch (\Exception $e)
        {
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
            $trip = trip::findOrFail($request->id);
            $trip->delete();
            $trips = trip::orderByDesc('id')->get();
            $micros = micro::all();
            $drivers = driver::all();
            toast('تم حذف الرحلة بنجاح', 'success');
            return view('home', compact('micros', 'drivers', 'trips'));
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function nowTrips(Request $request)
    {
        try
        {
            $todayDate = Carbon::now()->format('Y-m-d');
            $trips = trip::where('dateTrip', '>=', $todayDate)->get();
            $micros = micro::all();
            $drivers = driver::all();
            $check = '';
            return view('home', compact('micros', 'drivers', 'trips' , 'check'));
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
