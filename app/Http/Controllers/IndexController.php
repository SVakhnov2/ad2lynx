<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $data = Data::orderByDesc('impressions')->get();
        return view('index',compact('data'));
    }
}
