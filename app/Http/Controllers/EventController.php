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
            where('use_id', '=', \Auth::id())
            // where('user_id', '=', 1)
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
     * @param  App\Http\EventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        // var_dump($request->title);exit;
        // dd($request->file('files'));
        


        DB::transaction(function() use($request){

            
            //☆Eventテーブル登録処理
            // Eventオブジェクト生成
            $event = new \App\Models\Event;

            // 値の登録
            $event->user_id = \Auth::id();
            // $event->user_id = 1;
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

            // $event_detail = new \App\Models\EventDetail;
            // $event_detail->event_id	 = $id; //event_idを取得して入れる
            // $event_detail->number_from = $request->number_from;
            // $event_detail->number_to = $request->number_to;
            // $event_detail->avalable_date = $request->avalable_date;
            // $event_detail->avalable_time = $request->avalable_time;
            // $event_detail->place = $request->place;
            // $event_detail->price = $request->price;
            // $event_detail->event_type = $request->event_type;

            // $event_detail->save();


            //画像登録処理
            //もし$formにimageデータがあったら
            if ($request->file('files')) {
                $files = $request->file('files');
                // dd($files);
                
                foreach($files as $file){
                        $image = new \App\Models\Image;

                        // var_dump($file);exit;

                        $extension = $file->clientExtension();
                        // var_dump($extension);exit;

                        $file_token = Str::random(32);
                        $filename = $file_token . '.' . $extension;

                        $file->storeAS('public',$filename);
                        // var_dump($file);exit;


                        // $fileにイメージデータを格納する
                        $image->event_id = $id;
                        // $file = $request->file('image');
                        // var_dump($file);exit;

                        // getClientOrientalExtension()でファイルの拡張子を取得する
                        // $extension = $file->getClientOriginalExtension();
                        // $extension = $file->clientExtension();
                        // var_dump($extension);exit;

                        // $file_token = Str::random(32);
                        // $filename = $file_token . '.' . $extension;
                        // var_dump($filename);exit;
                        $image->image = $filename;
                        // 表示を行うときに画像名が必要になるため、ファイル名を再設定
                        // $form['image'] = $filename;
                        // $file->move('uploads/books', $filename);

                        $image->save();
                    }
                    // echo '<pre>';var_dump($image);echo '</pre>';exit;
                }

            
        //     



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
        // $event = Event::findOrFail($id);
        // var_dump($event);exit;

        return view('myeventShow', [
            'event' => Event::findOrFail($id)
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
        // dd($event);
        $event = Event::findOrFail($id);
        // var_dump($event);
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

        // dd($event_details);
        


        
            return view('myeventUpdate', compact('event','event_details'));



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
