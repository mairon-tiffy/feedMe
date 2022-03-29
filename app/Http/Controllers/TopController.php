<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
}