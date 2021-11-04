<?php
// require_once ('../inc/template-functions'); in templates/*/*.php
$if = function ($condition, $thenString, $elseString=null) { 
    return $condition ? $thenString : $elseString; 
};
