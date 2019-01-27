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
    $promise = $client->getAsync('http://httpbin.org/get');
    print_r($promise);
}
run();