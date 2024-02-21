<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|min:1',
            ]);

            User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'user_role' => 'user',
                'password' => Hash::make($request->password),
            ]);

            return redirect('/login')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menyimpan data ke database: ' . $e->getMessage()]);
        }
    }
}
