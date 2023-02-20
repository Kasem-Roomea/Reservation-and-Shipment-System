<?php

namespace App\Http\Controllers;

use App\Models\tickets;
use App\Models\trip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ticketsController extends Controller
{
    public function getTickets($id)
    {
        try{
            $todayDate = Carbon::now()->format('Y-m-d');
            $numTrips = trip::where('id', $id)->first();
            $countTickets = tickets::where('trip_id', $id)->count();
            $tickets = tickets::where('trip_id', $id)->get();
            $tripsDate = trip::where('dateTrip', '>=', $todayDate)->get();
        return view('Tickets', compact('tickets', 'numTrips', 'countTickets' , 'tripsDate'));
    }
    catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try{
        $rules = [
            'numTicket' => 'required',
            'namePerson' => 'required',
            'gender' => 'required',
            'from' => 'required',
            'to' => 'required',
            'Nationality' => 'required',
            'Birth' => 'date',
            'numPassport' => 'required',
            'datePassport' => 'required',
            'placePassport' => 'required',
            'description' => 'max:255',
        ];

        $messages = [
            'numTicket.required' => ' رقم التذكرة مطلوب',
            'namePerson.required' => ' اسم الشخص مطلوب',
            'gender.required' => '  نوع الجنس مطلوب',
            'from.required' => ' مكان الانطلاق مطلوب',
            'to.required' => ' مكان الوصول مطلوب',
            'Nationality.required' => 'الجنسية مطلوبة',
            'Birth.date' => 'تاريخ الميلاد يجب ان يكون من صيغة تاريخ',
            'numPassport.required' => '  رقم الجواز مطلوب',
            'datePassport.required' => ' تاريخ الجواز مطلوب',
            'placePassport.required' => ' مكان اصدار الجواز مطلوب',
            'description.max' => 'يجب ان لا يتجاوز الاحرف في محتوى الوصف عن 255 ',
        ];
        $validated = $request->validate($rules, $messages);


        tickets::create([
            'numTicket' => $request->numTicket,
            'namePerson' => $request->namePerson,
            'phonePerson' => $request->phonePerson,
            'gender' => $request->gender,
            'from' => $request->from,
            'to' => $request->to,
            'Nationality' => $request->Nationality,
            'Birth' => $request->Birth,
            'numPassport' => $request->numPassport,
            'datePassport' => $request->datePassport,
            'placePassport' => $request->placePassport,
            'numVisa' => $request->numVisa,
            'priceTicket' => $request->priceTicket,
            'paid' => $request->paid,
            'rest' => $request->rest,
            'description' => $request->description ?? '',
            'trip_id' => $request->idTrips,
        ]);

        session()->flash('Success', 'تم أضافة تذكرة جديد ');
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
            'numTicket' => 'required',
            'namePerson' => 'required',
            'gender' => 'required',
            'from' => 'required',
            'to' => 'required',
            'Nationality' => 'required',
            'Birth' => 'date',
            'numPassport' => 'required',
            'datePassport' => 'required',
            'placePassport' => 'required',
            'description' => 'max:255',
        ];

        $messages = [
            'numTicket.required' => ' رقم التذكرة مطلوب',
            'namePerson.required' => ' اسم الشخص مطلوب',
            'gender.required' => '  نوع الجنس مطلوب',
            'from.required' => ' مكان الانطلاق مطلوب',
            'to.required' => ' مكان الوصول مطلوب',
            'Nationality.required' => 'الجنسية مطلوبة',
            'Birth.date' => 'تاريخ الميلاد يجب ان يكون من صيغة تاريخ',
            'numPassport.required' => '  رقم الجواز مطلوب',
            'datePassport.required' => ' تاريخ الجواز مطلوب',
            'placePassport.required' => ' مكان اصدار الجواز مطلوب',
            'description.max' => 'يجب ان لا يتجاوز الاحرف في محتوى الوصف عن 255 ',
        ];
        $validated = $request->validate($rules, $messages);
        $ticketsUpdate = tickets::findOrFail($request->id);

        $ticketsUpdate->update([
            'numTicket' => $request->numTicket,
            'namePerson' => $request->namePerson,
            'phonePerson' => $request->phonePerson,
            'gender' => $request->gender,
            'from' => $request->from,
            'to' => $request->to,
            'Nationality' => $request->Nationality,
            'Birth' => $request->Birth,
            'numPassport' => $request->numPassport,
            'datePassport' => $request->datePassport,
            'placePassport' => $request->placePassport,
            'numVisa' => $request->numVisa,
            'priceTicket' => $request->priceTicket,
            'paid' => $request->paid,
            'rest' => $request->rest,
            'description' => $request->description ?? '',
        ]);

        session()->flash('Success', 'تم تعديل التذكرة بنجاح  ');
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
            $ticket= tickets::findOrFail($request->id);
            $ticket->delete();
            session()->flash('Delete', 'تم حذف التذكرة بنجاح  ');
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function TransferTickets(Request $request)
    {
        try
        {

            $ticketsUpdate = tickets::findOrFail($request->id);
            $ticketsUpdate->update([
                'trip_id' => $request->trips_id,
            ]);
            session()->flash('Success', 'تم نقل التذكرة بنجاح  ');
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
