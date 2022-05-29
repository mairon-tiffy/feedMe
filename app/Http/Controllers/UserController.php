<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // echo('<pre>');
        //     var_dump($request->all());Exit;
        // echo('</pre>');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function firstChange()
    {
        return view('user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
    }

    /**
     * Firstchange the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    public function firstChangeStore(Request $request)
    {
        $id = Auth::id();
        // var_dump($id);Exit;
        $user = $request;

            // echo('<pre>');
            // var_dump($request->all());Exit;
            // echo('</pre>');

            User::where('id', $id)->update([
                'country' => $user['country'],
                'information' => $user['information'],
                'user_type' => $user['user_type'],
                
            ]);

        return redirect()->to('userShow');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // return view('userShow');
        $id = Auth::id();
        // var_dump($id);exit;

        $user = User::
            where('id', '=', $id)
            ->get();

        // echo('<pre>');
        // var_dump($user[0]["name"]);exit;
        // echo('</pre>');
        
        return view('userShow', compact('user'));
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
