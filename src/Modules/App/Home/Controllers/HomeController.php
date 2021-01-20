<?php

namespace Modules\App\Home\Controllers;

class HomeController
{
    public function index()
    {
        return json_response([
            'status' => true,
            'msg' => 'Working good...'
        ]);
    }
}
