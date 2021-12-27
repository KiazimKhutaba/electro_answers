<?php

function to_json($value)
{
    return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
