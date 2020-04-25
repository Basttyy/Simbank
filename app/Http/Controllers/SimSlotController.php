<?php

namespace App\Http\Controllers;

use App\SimSlot;
use Illuminate\Http\Request;

class SimSlotController extends Controller
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
        $simSlots = SimSlot::all();
        return view('sim_slot.index')->with('sim_slots', $simSlots);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sim_slot.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $simSlot = new SimSlot();

        $simSlot->phone_num = $request->phone_num;
        $simSlot->balance = $request->balance;
        $simSlot->provider = $request->provider;

        $simSlot->save();

        $simSlots = SimSlot::all();
        return view('sim_slot.index')->with('sim_slots', $simSlots);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SimSlot  $simSlot
     * @return \Illuminate\Http\Response
     */
    public function show(SimSlot $simSlot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SimSlot  $simSlot
     * @return \Illuminate\Http\Response
     */
    public function edit(SimSlot $simSlot)
    {
        return view('sim_slot.edit')->with('sim_slot', $simSlot);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SimSlot  $simSlot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slot = new SimSlot();

        $simSlot = $slot->find($id);
        $simSlot->phone_num = $request->phone_num;
        $simSlot->provider = $request->provider;
        $simSlot->balance = $request->balance;

        $simSlot->update();

        $simSlots = SimSlot::all();
        return view('sim_slot.index')->with('sim_slots', $simSlots);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SimSlot  $simSlot
     * @return \Illuminate\Http\Response
     */
    public function destroy(SimSlot $simSlot)
    {
        $simSlot->delete();

        $simSlots = SimSlot::all();
        return view('sim_slot.index')->with('sim_slots', $simSlots);
    }
}
