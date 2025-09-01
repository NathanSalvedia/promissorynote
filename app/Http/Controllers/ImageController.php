<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function create()
    {
        return view('student.promissorynote');
    }



    public function store(){

        dd('Handle upload image');
    }
}
