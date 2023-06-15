<?php

// used in theme files include(__DIR__ . '/../../lib/template-functions.php');


$if = function ($condition, $thenString, $elseString = null) {
    return $condition ? $thenString : $elseString;
};
