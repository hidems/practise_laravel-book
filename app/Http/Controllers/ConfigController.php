<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigController extends Controller
{
    function __construct()
    {
        config(['sample.message' => 'New message!']);
    }

    public function index()
    {
        $sample_msg = config('sample.message');
        $sample_data = config('sample.data');
        $data = [
            'msg' => $sample_msg,
            'data' => $sample_data
        ];
        return view('configs.index', $data);
    }

    public function other()
    {
        return redirect()->route('redirect');
    }
}
