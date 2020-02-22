<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Text;

class TextController extends Controller
{
    public function get_text($value,$lang_id)
    {
    	foreach (Text::select('text')->where('params',$value)->where('lang_id',$lang_id)->get() as $select) {
            return $select->text;
        } 
    }
}
