<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstituteController extends Controller
{
   public function index(){
        return view('ins.dashboard');
   }

   public function addcourse(){
      return view('ins.addcourse');
   }
}
