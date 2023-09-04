<?php

namespace PostsRow;

global $config_location;
$config = require($config_location);

$remote_content = require('remote-content.php');

global $if,  $template_listing_location;
return require($template_listing_location);
