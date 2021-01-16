<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PagesController extends Controller
{ 
   
    public function __construct(){
        $this->middleware('config');
    }

    public function index(){
        $IndexClass = 'active'; 
        return view('pages.index')->with('IndexClass',$IndexClass);        
    }

    public function about(){
        $AboutClass = 'active';
        return view('pages.about')->with('AboutClass',$AboutClass);
    }
    
    public function help(){
        $HelpClass = 'active';
        return view('pages.help')->with('HelpClass',$HelpClass);
    }
     
}
