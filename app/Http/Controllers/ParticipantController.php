<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventDetail;
use App\Models\Event;
use App\Models\Participant;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        $participant = new \App\Models\Participant;

        $event_detail_id = $request->session()->pull('event_detail_id');


        $event_detail = EventDetail::findOrFail($event_detail_id);

        $participants = Participant::
        where('event_detail_id', '=', $event_detail_id)
        ->whereNull('deleted_at')
        ->first();

        $participant_sum = Participant::where('event_detail_id', '=', $event_detail_id)->sum('number');

        // dd($max);


        $number = $event_detail->number_to - $participant_sum;

        // $event = Event::
        // where('id', '=', $event_detail_id)
        // ->whereNull('deleted_at')
        // ->get();
        $this->validate($request, ['number' => 'required|integer|max:'. $number],['required'    => ':attributeを入力してください。',
        'max'         => '参加可能人数はあと:max人です。',]);

        


        // 値の登録
        $participant->user_id = \Auth::id();
        $participant->number = $request->number;
        $participant->event_detail_id = $event_detail_id;

        // dd($event_detail);

        // 保存
        $participant->save();

        return view('participant', compact('participant', 'event_detail'));


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
