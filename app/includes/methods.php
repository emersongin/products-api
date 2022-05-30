<?php

$GLOBALS['_DELETE'] = [];
$GLOBALS['_PUT'] = [];

if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE')) {
    $GLOBALS['_DELETE'] = json_decode(file_get_contents('php://input', true), true);
    parse_str(file_get_contents('php://input', false), $_DELETE);
}

if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'PUT')) {
    $GLOBALS['_PUT'] = json_decode(file_get_contents('php://input', true), true);
    parse_str(file_get_contents('php://input', false), $_PUT);
}
