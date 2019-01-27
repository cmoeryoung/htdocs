<?php
/**
 * User: Cmoer
 * Date: 2019/1/27
 * Time: 14:52
 */
require_once __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

function run(){
    //需要爬取页面的URL
    $url = "https://www.amazon.com";
    //伪造浏览器UA



    $headers = [
        'user-agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36',
    ];
}