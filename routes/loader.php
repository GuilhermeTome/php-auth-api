<?php

use Core\Constants\ResponseConstant;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;

require PATH_ROUTE . 'load' . DS . 'app.php';

SimpleRouter::error(function (Request $request, \Exception $exception) {
    if ($exception instanceof NotFoundHttpException && $exception->getCode() === 404) {
        return json_response(['status' => false, 'msg' => 'Page not found'], ResponseConstant::NOT_FOUND);
    }
});

SimpleRouter::all('/maintenance', function () {
    return json_response(['status' => false, 'msg' => 'Application under maintenance'], ResponseConstant::SERVICE_UNAVAILABLE);
});
