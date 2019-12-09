<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthUser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function isLogin()
    {
        if ((session()->has('user'))){
            $client = new \GuzzleHttp\Client();
            $url = config('app.auth').'/api/getsession/'.session()->get('user')['user_id'];
            // .session()->get('auth')['session_id'];
            $response = $client->get($url);
            return $response->getBody();
        }
    }

    public function setSession(Request $request)
    {
        $user_id = $request->user_id;
        $session_id = $request->session_id;
        echo $user_id;
        echo $session_id;
        session(['user'=>[
            'user_id' => $user_id,
            'session_id' => $session_id,
        ]]);
        session()->reflash();
        // $request->session()->put('user', [
        //     'user_id' => $user_id,
        //     'session_id' => $session_id,
        // ]);
        // echo session()->get('user')['user_id'];
        return  redirect()->route('shop.index');
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
