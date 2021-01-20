<?php

/**
 * more info in https://httpstatuses.com/
 */

namespace Core\Constants;

class ResponseConstant
{
    const OK = 200;
    const NO_CONTENT = 204;

    const UNAUTORIZED = 401;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;

    const INTERNAL_SERVER_ERROR = 500;
    const SERVICE_UNAVAILABLE = 503;
}
