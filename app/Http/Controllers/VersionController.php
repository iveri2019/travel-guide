<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\version;

class VersionController extends Controller
{

   	public function get_version($method)
    {
        foreach (version::where('method',$method)->get() as $version) {
          	return $version->version;
        }
    }
    public function update($method)
    {
    	$update = $this->get_version($method)+1;

    	$a = version::where('method',$method)->update(['version',$update]);
    	 
    	if ($a) {

    		return $update;

    	}else{

    		dd('failed!');

    	}
    }
}
