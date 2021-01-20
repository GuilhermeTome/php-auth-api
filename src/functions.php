<?php

use Core\Constants\ResponseConstant;
use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Url;
use Pecee\Http\Response;
use Pecee\Http\Request;

/**
 * Get url for a route by using either name/alias, class or method name.
 *
 * The name parameter supports the following values:
 * - Route name
 * - Controller/resource name (with or without method)
 * - Controller class name
 *
 * When searching for controller/resource by name, you can use this syntax "route.name@method".
 * You can also use the same syntax when searching for a specific controller-class "MyController@home".
 * If no arguments is specified, it will return the url for the current loaded route.
 *
 * @param string|null $name
 * @param string|array|null $parameters
 * @param array|null $getParams
 * @return \Pecee\Http\Url
 * @throws \InvalidArgumentException
 */
function url(
    ?string $name = null,
    $parameters = null,
    ?array $getParams = null
): Url {
    return Router::getUrl($name, $parameters, $getParams);
}

/**
 * @return \Pecee\Http\Response
 */
function response(): Response
{
    return Router::response();
}

/**
 * @return \Pecee\Http\Request
 */
function request(): Request
{
    return Router::request();
}

/**
 * Get input class
 * @param string|null $index Parameter index name
 * @param string|null $defaultValue Default return value
 * @param array ...$methods Default methods
 * @return \Pecee\Http\Input\InputHandler|array|string|null
 */
function input($index = null, $defaultValue = null, ...$methods)
{
    if ($index !== null) {
        return request()
            ->getInputHandler()
            ->value($index, $defaultValue, ...$methods);
    }

    return request()->getInputHandler();
}

function input_post($index, $defaultValue = null)
{
    if (isset($_POST[$index]) && trim($_POST[$index]) != '') {
        return $_POST[$index];
    }

    return $defaultValue;
}

/**
 * @param string $url
 * @param int|null $code
 */
function redirect(string $url, ?int $code = null): void
{
    if ($code !== null) {
        response()->httpCode($code);
    }

    response()->redirect($url);
}

/**
 * Get current csrf-token
 * @return string|null
 */
function csrf_token(): ?string
{
    $baseVerifier = Router::router()->getCsrfVerifier();
    if ($baseVerifier !== null) {
        return $baseVerifier->getTokenProvider()->getToken();
    }

    return null;
}

/**
 * @param string $url
 * @return void
 */
function asset(string $url = '')
{
    $protocol = (isset($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') ? 'https://' : 'http://';
    return $protocol . url()->getHost() . url('assets') . $url;
}

/**
 * @param array $response
 * @param integer $code
 * @return void
 */
function json_response(array $response, int $code = 200)
{
    return response()->httpCode($code)->json($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}

/**
 * @param Throwable $th
 * @return void
 */
function catchException(Throwable $th)
{
    $msg = $th->getCode() === 1 ? $th->getMessage() : 'Internal server error';
    $code = $th->getCode() === 1 ? ResponseConstant::OK : ResponseConstant::INTERNAL_SERVER_ERROR;

    if ($th->getCode() !== 1 && DISPLAY_ERRORS) {
        $msg = $th->getMessage();
    }

    return json_response([
        'status' => false,
        'msg' => $msg
    ], $code);
}
