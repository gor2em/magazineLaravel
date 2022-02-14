<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SingleController extends Controller
{
    public function index(Request $req)
    {
        return view("view");
    }

    public function save(Request $req)
    {

        $validate = $req->validate([
            'key' => 'required|string',
            'key' => 'required|image'
        ]);
        return view('view');
    }
}
