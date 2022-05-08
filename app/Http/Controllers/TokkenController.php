<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class TokkenController extends Controller
{
    public function index(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'access_token' => $request->user()->createToken('api')->plainTextToken
        ]);
    }
}
