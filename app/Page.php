<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    public function color()
    {
        return $this->hasOne('App\Color');
    }

    public function logo(){
        return $this->hasOne('App\Logo');
    }

    public function slogan(){
        return $this->hasOne('App\Slogan');
    }
}
