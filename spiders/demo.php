<?php
/**
 * Created by PhpStorm.
 * User: cmoer
 * Date: 2019-01-25
 * Time: 22:02
 */
require "get_html.php";

header( "Content-type:text/html;Charset=utf-8" );

$html = get_html("http://www.amazon.com");
$pattern = '/<title>(.*?)<\/title>/si';
preg_match($pattern,$html,$result);
print_r($html);