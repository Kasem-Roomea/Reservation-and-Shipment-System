<?php

namespace App\Http\Controllers;

use App\Models\trip;
use App\Models\Trustees;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class trusteesController extends Controller
{
    public function getTrustees($id)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $numTrips = trip::where('id',$id )->first();
        $countTrustees = Trustees::where('trip_id',$id )->count();
        $trustees = Trustees::where('trip_id' , $id)->get();
        $tripsDate = trip::where('dateTrip', '>=', $todayDate)->get();
        return view('Trustees' , compact('trustees' , 'numTrips' , 'countTrustees', 'tripsDate'));
    }
    public function store(Request $request)
    {
        try{
            $rules = [
                'senderName' => 'required',
                'senderPhone' => 'required',
                'senderPlace' => 'required',
                'receiverName' => 'required',
                'receivedPhone' => 'required',
                'price' => 'required',
                'paid' => 'required',
                'description' => 'max:255',
            ];

            $messages = [
                'senderName.required' => 'اسم المرسل مطلوب',
                'senderPhone.required' => 'رقم المرسل مطلوب',
                'senderPlace.required' => 'جهة الأرسال مطلوبة',
                'receiverName.required' => 'اسم المرسل اليه مطلوب',
                'receivedPhone.required' => 'رقم المرسل اليه',
                'price.required' => 'سعر الأمانة مطلوب',
                'paid.required' => 'الباقي من السعر الاصلي للامانة مطلوب',
                'description.required' => 'وصف الأمانة مطلوب',
            ];
            $validated = $request->validate($rules, $messages);


            Trustees::create([
                'senderName' => $request->senderName,
                'senderPhone' => $request->senderPhone,
                'senderPlace' => $request->senderPlace,
                'receiverName' => $request->receiverName,
                'receivedPhone' => $request->receivedPhone,
                'receivedPhoneS' => $request->receivedPhoneS?? 0,
                'price' => $request->price,
                'paid' => $request->paid,
                'description' => $request->description,
                'byName' => Auth::user()->name,
                'trip_id' => $request->idTrips,
            ]);

            session()->flash('Success', 'تم أضافة أمانة جديد ');
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try{
            $rules = [
                'senderName' => 'required',
                'senderPhone' => 'required',
                'senderPlace' => 'required',
                'receiverName' => 'required',
                'receivedPhone' => 'required',
                'price' => 'required',
                'paid' => 'required',
                'description' => 'max:255|required',
            ];

            $messages = [
                'senderName.required' => 'اسم المرسل مطلوب',
                'senderPhone.required' => 'رقم المرسل مطلوب',
                'senderPlace.required' => 'جهة الأرسال مطلوبة',
                'receiverName.required' => 'اسم المرسل اليه مطلوب',
                'receivedPhone.required' => 'رقم المرسل اليه',
                'price.required' => 'سعر الأمانة مطلوب',
                'paid.required' => 'الباقي من السعر الاصلي للامانة مطلوب',
                'description.required' => 'وصف الأمانة مطلوب',
                'description.max' => 'وصف الأمانة يجب ان لا يتخطى 255 كلمة',
            ];
            $validated = $request->validate($rules, $messages);
            $trusteesUpdate =Trustees::findOrFail($request->id);

            $trusteesUpdate->update([
                'senderName' => $request->senderName,
                'senderPhone' => $request->senderPhone,
                'senderPlace' => $request->senderPlace,
                'receiverName' => $request->receiverName,
                'receivedPhone' => $request->receivedPhone,
                'receivedPhoneS' => $request->receivedPhoneS ?? 0,
                'price' => $request->price,
                'paid' => $request->paid,
                'description' => $request->description,
                'byName' => Auth::user()->name,
            ]);

            session()->flash('Success', 'تم تعديل الأمانة بنجاح  ');
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try
        {
            $Trustees= Trustees::findOrFail($request->id);
            $Trustees->delete();
            session()->flash('Delete', 'تم حذف الأمانة بنجاح  ');
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function TransferTrustees(Request $request)
    {
        try
        {

            $trusteesUpdate = Trustees::findOrFail($request->id);
            $trusteesUpdate->update([
                'trip_id' => $request->trips_id,
            ]);
            session()->flash('Success', 'تم نقل الأمانة بنجاح  ');
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
