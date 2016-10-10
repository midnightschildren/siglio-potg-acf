<?php
/**
 * Delete this file and lib/ when releasing to production,
 * we're uninterested in maintaining protection against
 * injection attacks
 * 
 * Make sure to copy the output of this file to the 
 * corresponding .css file in css/
 */

header("Content-type: text/css");

require '../lib/lessphp/lessc.inc.php';

$file = $_GET["file"];

try {
	$less = new lessc($file . '.less');
	$css = $less->parse();
} catch (exception $ex) {
    echo $ex->getMessage();
    exit('lessc fatal error:<br />'.$ex->getMessage());
}

echo $css;