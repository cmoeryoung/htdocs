<?php
/**
 * Created by PhpStorm.
 * User: Cmoer
 * Date: 2/13/2019
 * Time: 5:40 PM
 */
require "get_html.php";

header( "Content-type:text/html;Charset=utf-8" );

$url = "https://www.amazon.com/ask/questions/asin/B005BINV84/1?askLanguage=en_US";
$content = get_html($url);
print_r($content);