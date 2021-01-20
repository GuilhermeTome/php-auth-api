<?php

namespace Modules\App;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class Middleware implements IMiddleware
{
    public function handle(Request $request): void
    {
        if (MAINTENANCE) {
            redirect('/maintenance');
        }
    }
}
