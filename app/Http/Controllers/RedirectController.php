<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function cek() {
        if (auth()->user()->user_role === 'admin') {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/guru/dashboard');
        }
    }
}
