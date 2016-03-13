<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TesController extends Controller
{
    public function index()
    {
      return view('pegawai.tes1');
    }

    public function index2()
    {
      return view('pegawai.tes2');
    }
}
