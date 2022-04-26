<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventDetail;
use App\Http\Requests\EventRequest;
use DB;

class EventController extends Controller
{

    //バリデーション
    public function check(EventRequest $request)
    {
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::
        //  ->where('use_id', '=', \Auth::id())
            where('user_id', '=', 1)
            ->whereNull('deleted_at')
            ->get();

        // dd($events);
        

        return view('myeventIndex', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('myevent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // var_dump($request->title);exit;

        DB::transaction(function() use($request){
            
            //☆Eventテーブル登録処理
            // Eventオブジェクト生成
            $event = new \App\Models\Event;

            // 値の登録
            // $event->user_id = \Auth::id();
            $event->user_id = 1;
            $event->title = $request->title;
            $event->content = $request->content;
            $event->currecy_type = $request->currecy_type;
            $event->cuisine_type = $request->cuisine_type;
            $event->special_diet = $request->special_diet;

            // 保存
            $event->save();


            //☆EventDetailテーブル登録処理

            //eventID取得
            $id = $event->id;
            // var_dump($id);

            $event_detail = new \App\Models\EventDetail;
            $event_detail->event_id	 = $id; //event_idを取得して入れる
            $event_detail->number_from = $request->number_from;
            $event_detail->number_to = $request->number_to;
            $event_detail->avalable_date = $request->avalable_date;
            $event_detail->avalable_time = $request->avalable_time;
            $event_detail->place = $request->place;
            $event_detail->price = $request->price;
            $event_detail->event_type = $request->event_type;

            $event_detail->save();

        });

        // 一覧にリダイレクト
        return redirect()->to('events/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        // var_dump($event);

        //findOrFailを主キー以外で取得する（whereを使う）
        $event_detail = EventDetail::where('event_id', $id)->firstOrFail();
        // var_dump($event_detail);exit;

        return view('myeventUpdate', compact('event', 'event_detail'));


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
        DB::transaction(function() use($request, $id){

            $event_data = $request;

            // echo('<pre>');
            // var_dump($request->all());Exit;
            // echo('</pre>');

            Event::where('id', $id)->update([
                'content' => $event_data['content'],
                'title' => $event_data['title'],
                'currecy_type' => $event_data['currecy_type'],
                'cuisine_type' => $event_data['cuisine_type'],
                'special_diet' => $event_data['special_diet'],
                
            ]);

            EventDetail::where('event_id', $id)->update([
                'number_from' => $event_data['number_from'],
                'number_to' => $event_data['number_to'],
                'avalable_date' => $event_data['avalable_date'],
                'avalable_time' => $event_data['avalable_time'],
                'place' => $event_data['place'],
                'price' => $event_data['price'],
                'event_type' => $event_data['event_type'],
                
            ]);
        // 一覧にリダイレクト
        return redirect()->to('events');

        });
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
