<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;


use Illuminate\Http\Request;

class ChatController extends Controller
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

    public function message(Request $request, $host_id)
    {
        //
        $request->session()->put('host_id', $host_id);

        $guest_id = Auth::id();

        $chats = Chat::where(function ($query) use ($guest_id, $host_id) {
            $query->where('host_id', '=', $guest_id)
                  ->orWhere('host_id', '=', $host_id);
        })
        ->where(function ($query) use ($guest_id, $host_id) {
            $query->where('guest_id', '=', $guest_id)
                  ->orWhere('guest_id', '=', $host_id);
        })
        ->get();

        // var_dump($chats);exit;



        return view('chat', compact('chats'));
        
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
        $chat = new \App\Models\Chat;

        

        $guest_id = Auth::id();
        $message = $request->message;
        $host_id = $request->session()->pull('host_id');


        // var_dump($host_id);exit;


        $chat->host_id = $host_id;
        $chat->guest_id = $guest_id;
        $chat->message = $message;

        $chat->save();

        return redirect()->to('chat/message/'.$host_id);


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
