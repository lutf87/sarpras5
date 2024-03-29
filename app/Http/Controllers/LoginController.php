<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

public function dologin(Request $request) {
    // validasi
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (auth()->attempt($credentials)) {

        // buat ulang session login
        $request->session()->regenerate();

        if (auth()->user()->user_role === 'admin') {
            // jika user superadmin
            return redirect()->intended('/admin');
        } else {
            // jika user pegawai
            return redirect()->intended('/guru');
        }

        // jika email atau password salah
        // kirimkan session error
        return back()->with('error', 'email atau password salah');
    }}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

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
