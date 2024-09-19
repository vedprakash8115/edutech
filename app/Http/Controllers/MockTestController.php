<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MockTestController extends Controller
{
    public function index()
    {
        return view('ins.mock_test.mock_test');
    }
    public function form()
    {
        return view('ins.mock_test.submit_form');
    }
    public function question()
    {
        return view('ins.mock_test.question_form');
    }
}
