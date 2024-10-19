<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Videos;

class TestController extends Controller
{
    public function index(){
        return view("user-account.content.tests");
    }
}
