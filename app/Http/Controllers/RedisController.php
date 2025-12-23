<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    
    public function index()
    {
        Redis::set("firstname","Mike");
        return response()->json(['data'=>"Record created in redis"]);
    }
}
