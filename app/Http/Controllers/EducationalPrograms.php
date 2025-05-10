<?php

namespace App\Http\Controllers;

use App\Models\Program\Program;
use Illuminate\Http\Request;

class EducationalPrograms extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function show($locale, Program $educational_program)
    {
        return $this->view('educational-programs.show', compact('educational_program'));
    }
}
