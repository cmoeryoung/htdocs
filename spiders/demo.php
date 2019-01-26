<?php
/**
 * Created by PhpStorm.
 * User: cmoer
 * Date: 2019-01-25
 * Time: 22:02
 */
require "get_html.php";

$html = get_html("https://www.baidu.com");
$pattern = '/<title>(.*?)<\/title>/si';
preg_match($pattern,$html,$result);
print_r($result);