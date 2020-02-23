<?php

namespace App\Http\Controllers;
use App\version;
use Illuminate\Http\Request;
use input;
class HomeController extends VersionController
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function get_first_frame()
    {
        $ver = new VersionController();
        $color = new ColorController();
        $image = new ImageController();
        $text = new TextController();
        $data2 = json_decode(file_get_contents('php://input'),true);
        $data = [
            'params' => [
                'logo_link' => $image->get_image('get_first_frame_logo'),
                    // POST REQUEST
                'old_version' => $data2['params']['version'],
                'bg_link'  => $image->get_image('get_first_frame'),
                'slogan'   => $text->get_text('get_first_frame_slogan',0),
                'bg_color' => $color->get_color('get_first_frame'),
                'Version'  => $ver->get_version('get_first_frame')
            ]
        ];

    return json_encode($data,JSON_UNESCAPED_UNICODE);
    }

    
}

