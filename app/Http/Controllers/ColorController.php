<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Color;

class ColorController extends Controller
{
    public function get_color($value)
    {
    	foreach (Color::select('color')->where('params',$value)->get() as $select) {
            return $select->color;
        } 
    }
}
