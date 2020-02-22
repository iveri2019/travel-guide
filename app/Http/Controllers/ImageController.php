<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BgImage;

class ImageController extends Controller
{
   public function get_image($value)
    {
    	foreach (BgImage::select('link')->where('params',$value)->get() as $select) {
            return $select->link;
        } 
    }
}
