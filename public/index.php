<?php
header("Access-Control-Allow-Origin: *");
session_start();

require_once '../vendor/autoload.php';

/**
 * load the application
 */
Pecee\SimpleRouter\SimpleRouter::start();
