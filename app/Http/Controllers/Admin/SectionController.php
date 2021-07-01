<?php

namespace App\Http\Controllers\Admin;

use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    public function sections(){
        $sections = Section::get();
        return view('admin.sections.sections',compact('sections'));
    }
}
