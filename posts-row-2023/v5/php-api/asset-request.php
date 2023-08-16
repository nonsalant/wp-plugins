<?php

// Allow CORS from specific domains
$allowed_origins = array(
	'http://86.121.71.113', // local IP, used for development
	'https://www.test-cors.org', //eg, test: https://vileworks.com/testing-cors/
	// 'https://www.example.com',
	// 'https://example.com',
	// //'https://cdpn.io', // ⚠️ only in staging
);
function allow_remote_CORS($allowed_origins=[]) {
	$origin = $_SERVER['HTTP_ORIGIN'];
	if ( in_array($origin, $allowed_origins) ) {
		header('Access-Control-Allow-Origin: ' . $origin);
		return;
	}
}
allow_remote_CORS($allowed_origins);
// End of CORS


// Allow only specific extensions

$asset_file = __DIR__ . '/../' . $_GET['f'];
// $asset_file .= '&v=' . time(); // bust cache w/ current timestamp
$extension = pathinfo($asset_file, PATHINFO_EXTENSION);

// check if the extension is one of the allowed ones
$allowed_extensions = ['css', 'js', 'html'];
if ( ! in_array($extension,$allowed_extensions) ) {
	http_response_code(403);
	die();
}

// check if file exists
if ( ! file_exists($asset_file) ) {
	http_response_code(404);
	die(); //die($asset_file.' does not exist.');
}

// set MIME type
switch ($extension) {
	case 'html': break;
	case 'css': header("Content-type: text/css; charset: UTF-8"); 		break;
	case 'js': header("Content-type: text/javascript; charset: UTF-8"); break;
}

// don't cache
header("Expires: 0");

// $output = $asset_file;
$output = file_get_contents($asset_file);

echo $output;

?>