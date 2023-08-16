<?php

// Allow CORS -- used for local dev

if (isset($_GET['key']) && ('179x13a9e' == $_GET['key'])) {
    header('Access-Control-Allow-Origin: *');
    header('Expires: 0');
}