<?php
/**
 * User: cmoer
 * Date: 2019-01-25
 * Time: 22:02
 */
require "get_html.php";
require 'vendor/autoload.php';
use Symfony\Component\DomCrawler\Crawler;

header( "Content-type:text/html;Charset=utf-8" );

$html = get_html($url="https://www.baidu.com/",$cookie="session-id=140-2340524-3242001; session-id-time=2082787201l; i18n-prefs=USD; ubid-main=130-0771934-9305657; x-wl-uid=1fFn8Vi7ygVfotM0KjRmBD1SI3HMCk2OEtxLHXCxlTJ8Yd+ryfP6pjH2Z2hP/MVaN17UdUOiZKck=; session-token=oUrlODb8ysnFCmUk3y7mNLN48nWgMtxwalqNl6/9lWcfO9NG2AsVlMGSLn0vlPPU6LT/LKeBGRm0LOrDukGPhZ3pyTmTg/WNIp99fTHtPAZN1ixKCI1rBD8RowwdLLXbeaSR/uLP2Xi0iB349q1FdnaaiVR7I4JxgTH3EYOjjsN78tpA10vTTkHLNdtDL8oz; skin=noskin");
$crawler = new Crawler($html);
$title = $crawler->getNode();