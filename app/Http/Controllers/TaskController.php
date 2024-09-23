<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function add_task()
    {
        try {
            return response()->json([
                'message' => "hello"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error'
            ]);
        }
    }
}
