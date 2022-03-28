<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AfiliadosController extends Controller
{
    public function index()
    {
        /*
            dump($request->user());
        $user_id = Auth::user()->usuario_id;
        echo $user_id;
        $usuario = 
        dump(Auth::user());
        */
        return response()->json([
            'status' => 200,
            'response' => Auth::user()
        ], 200);
    }
}
