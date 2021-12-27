<?php

function to_json($value, $flags = JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
{
    return json_encode($value, $flags);
}


function env2(string $varName) {
    return $_ENV[$varName] ?: "";
}