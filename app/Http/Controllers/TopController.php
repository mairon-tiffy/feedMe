<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
// use App\Models\User;

class TopController extends Controller
{
    /**
     * 指定ユーザーのプロファイルを表示
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('top');
    }


    public function search(Request $request)

    {
        // $id = Auth::id();
        // echo('<pre>');
        // var_dump($request->date);Exit;
        // echo('</pre>');
        $posts = $request->freeword;
        $cuisineType = $request->cuisine_type;
        $date = $request->date;
        $guest = $request->guest;
        $eventType = $request->event_type;
        $specialDiet = $request->special_diet;

        // echo '<pre>';
        // var_dump($date);exit;
        // echo '</pre>';


        $events = EVENT::select('events.*','detail.*')
            // ->from('events as events')
            ->join('event_details as detail', function($join) {
                $join->on('detail.event_id', '=', 'events.id');
            });

        if(!empty($posts)){
            $events = $events->where('content', 'LIKE','%'.$posts.'%');
        }

        if($cuisineType !== ''){
            $events = $events->where('cuisine_type', '=',$cuisineType);
        }

        if(!empty($eventType)){
            $events = $events->where('event_type', '=',$eventType);
        }

        if(!empty($specialDiet)){
            $events = $events->where('special_diet', '=',$specialDiet);
        }

        if(!empty($date)){
            $events = $events->where('avalable_date', '=',$date);
        }



        
        // $events = EVENT::select('events.*','detail.*')
        //     ->join('event_details as detail', function($join) {
        //         $join->on('detail.event_id', '=', 'events.id');
        //     })
        //     ->where('cuisine_type', '=',$cuisineType)
        //     // ->where('number_from', '<=',$guest,'>=','number_to')
        //     ->where('event_type', '=',$eventType)
        //     ->where('special_diet', '=',$specialDiet)
        //     ->where('avalable_date', '=',$date)
        //     ->get();

        $events = $events->get();
        // $events = $events->toSql();

        // echo '<pre>';
        // var_dump($events);exit;
        // echo '</pre>';

            // $eventType = [    
            //     '0' => 'Dinner',
            //     '1' =>'Lunch',
            //     '2' => 'Brunch',
            //     '3' => 'Breakfast',
            //     '4' => 'Tea time',
            //     '5' => 'Picnic',
            //     '6' => 'Others',
            // ];


            // echo('<pre>');
            // var_dump($events);exit;
            // echo('</pre>');

            return view('top', compact('events'));
    }

}