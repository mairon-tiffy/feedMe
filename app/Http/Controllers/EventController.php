<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventDetail;
use App\Models\Image;
use App\Http\Requests\EventRequest;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::
            where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->get();

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
     * @param  App\Http\EventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        // var_dump($request->title);exit;
        
        $event_id = DB::transaction(function() use($request){

            
            //☆Eventテーブル登録処理
            // Eventオブジェクト生成
            $event = new \App\Models\Event;

            // 値の登録
            $event->user_id = \Auth::id();
            $event->title = $request->title;
            $event->content = $request->content;
            $event->currecy_type = $request->currecy_type;
            $event->cuisine_type = $request->cuisine_type;
            $event->special_diet = $request->special_diet;

            // 保存
            $event->save();

            //eventID取得
            $id = $event->id;


            //画像登録処理
            //もし$formにimageデータがあったら
            if ($request->file('files')) {
                $files = $request->file('files');
                
                foreach($files as $file){
                    $image = new \App\Models\Image;

                    $extension = $file->clientExtension();
                    // var_dump($extension);exit;

                    $file_token = Str::random(32);
                    $filename = $file_token . '.' . $extension;

                    $file->storeAS('public',$filename);

                    // $fileにイメージデータを格納する
                    $image->event_id = $id;

                    $image->image = $filename;

                    $image->save();
                }
            }
            return $id;
        });
    
    // 一覧にリダイレクト
    // return redirect()->to('events/');
    return redirect()->to('events/'.$event_id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $event_details = EventDetail::
        where('event_id', '=', $id)
        ->whereNull('deleted_at')
        ->get();


        return view('myeventShow', [
            'event' => Event::findOrFail($id)
        ],compact('event_details'));
        

    // var_dump($event_details);exit;

    // return view('myeventShow', compact('event_details'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($event);
        $event = Event::findOrFail($id);
        // dd($event->event_details[0]->price);

        //findOrFailを主キー以外で取得する（whereを使う）
        // $event_detail = EventDetail::where('event_id', $id)->firstOrFail();

        //☆下記が必要
        // $event_detail = $event->event_details[0];

        // echo '<pre>';
        // var_dump($event->images);exit;
        // echo '</pre>';
        // $img = Image::where('event_id', $id)->firstOrFail();
            // $img = $event->images[];
            // echo '<pre>';var_dump($img);exit;echo '</pre>';

        $event_details = EventDetail::
            where('event_id', '=', $id)
            ->whereNull('deleted_at')
            ->get();

        return view('myeventUpdate', compact('event','event_details'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
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

            // EventDetail::where('event_id', $id)->update([
            //     'number_from' => $event_data['number_from'],
            //     'number_to' => $event_data['number_to'],
            //     'avalable_date' => $event_data['avalable_date'],
            //     'avalable_time' => $event_data['avalable_time'],
            //     'place' => $event_data['place'],
            //     'price' => $event_data['price'],
            //     'event_type' => $event_data['event_type'],
                
            // ]);
        // 一覧にリダイレクト
        // return redirect()->to('myeventUpdate');
        // dd('events/'.$id.'/edit');
        return redirect()->to('events/'.$id.'/edit');

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
