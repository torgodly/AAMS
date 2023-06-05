<?php

namespace App\Http\Controllers;

use App\Models\UsersImport;
use Illuminate\Http\Request;

class StudentController extends Controller
{


    //store
    public function store(Request $request)
    {

        UsersImport::import();

        return redirect()->route('dashboard')->with('Message', 'Student created successfully.');
    }
}
