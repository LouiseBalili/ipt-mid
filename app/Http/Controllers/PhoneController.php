<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Events\UserLog;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('phone.index', [
            'phones' => Phone::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('phone.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'phone_name' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'price' => ['required', 'numeric'],
        ]);

        $log_entry = auth()->user()->name.' has added a phone to the list.';

        UserLog::dispatch($log_entry); //calling the UserLog event with dispatch method and passed the $log_entry as parameter

        Phone::create($attributes);

        return redirect('/phones')->with('success', 'Phone has been added to the list.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Phone $phone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Phone $phone)
    {
        // dd($phone);
        return view('phone.edit', [
            'phone' => $phone
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Phone $phone)
    {
        $attributes = $request->validate([
            'phone_name' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'price' => ['required', 'numeric'],
        ]);

        $log_entry = auth()->user()->name.' has updated a phone from the list.';

        UserLog::dispatch($log_entry);

        $phone->update($attributes);

        return redirect('/phones')->with('success', 'Phone has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Phone $phone)
    {
        $phone->delete();

        $log_entry = auth()->user()->name.' has removed a phone from the list.';

        UserLog::dispatch($log_entry); //calling the UserLog event with dispatch method and passed the $log_entry as parameter

        return back()->with('success', 'Phone has been removed from the list.');
    }
}
