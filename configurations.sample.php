<?php

/**
 * Internal configurations
 */
define('DS', DIRECTORY_SEPARATOR);
define('PATH_ROOT', __DIR__ . DS);

define('PATH_PUBLIC', PATH_ROOT . 'public' . DS);
define('PATH_UPLOAD', PATH_PUBLIC . 'uploads' . DS);

define('PATH_RESOURCE', PATH_ROOT . 'resource' . DS);
define('PATH_CACHE', PATH_ROOT . 'cache' . DS);
define('PATH_ROUTE', PATH_ROOT . 'routes' . DS);

/**
 * Security configurations
 */
define('UNIQID_HASH', 'my_big_hash');

/**
 * Database configurations
 */
define('DB_TYPE', 'mysql');
define('DB_NAME', 'db');
define('DB_HOST', 'mysql');
define('DB_USER', 'root');
define('DB_PWD', 'password');
define('DB_PORT', '3307');
define('DB_CHARSET', 'utf8mb4');

/**
 * Server configurations
 */
define('MAINTENANCE', false); // app stop
define('HTTP_PROTOCOL', 'http://');
define('DISPLAY_ERRORS', true);

/**
 * JWT CONSTANTS
 */

// the key of the application
define('JWT_SECRET', 'mysecret');

// the hash of the jwt
define('JWT_HASH', 'sha256');

// the alg to put in header
define('JWT_ALG', 'HS256');
