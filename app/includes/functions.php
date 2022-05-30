<?php

function parseInt($dado) {
    return intval($dado) > 0 ? intval($dado) : false;
}

function parseNumeric($dado) {
    return is_numeric($dado) ? intval($dado) : false;
}

function parseText($dado) {
    return is_string($dado) && strlen($dado) > 2 ? $dado : false;
}

function ok($dado = true, $code = 200) {
    http_response_code($code);

    return json_encode($dado);
}

function fail($erro = false, $code = 400) {
    http_response_code($code);

    return json_encode($erro);
}