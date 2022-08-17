<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventDetail;

class EventDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        //

        //eventID取得
        $event_id = $id;

        $event_details = EventDetail::
            where('event_id', '=', $event_id)
            ->whereNull('deleted_at')
            ->get();

        // var_dump($event_details);exit;
        

        return view('myeventUpdate', compact('event_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $event_id)
    {
        //
        $request->session()->put('event_id', $event_id);

        return view('myeventdetailCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //eventID取得
        $event_id = $request->session()->pull('event_id');
        // var_dump($event_id);exit;

        $event_detail = new \App\Models\EventDetail;

        $event_detail->event_id	 = $event_id;
        $event_detail->number_from = $request->number_from;
        $event_detail->number_to = $request->number_to;
        $event_detail->avalable_date = $request->avalable_date;
        $event_detail->avalable_time = $request->avalable_time;
        $event_detail->place = $request->place;
        $event_detail->price = $request->price;
        $event_detail->event_type = $request->event_type;

        $event_detail->save();

        return redirect()->to('events/'.$event_id.'/edit');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $request->session()->put('event_detail_id', $id);

        return view('myeventdetailShow', [
            'eventDetail' => EventDetail::findOrFail($id)
        ]);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
