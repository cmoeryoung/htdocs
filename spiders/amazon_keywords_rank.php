<?php
/**
 * Created by PhpStorm.
 * User: Cmoer
 * Date: 2019/1/27
 * Time: 11:55
 */
require "get_html.php";

header( "Content-type:text/html;Charset=utf-8" );
$base_url = "https://www.amazon.com/s/?keywords=";
$keywords = "fanny pack";
$url = $base_url.$keywords;
try{
    $html = get_html($url=$url,$cookie="session-id=140-2340524-3242001; session-id-time=2082787201l; i18n-prefs=USD; ubid-main=130-0771934-9305657; x-wl-uid=1fFn8Vi7ygVfotM0KjRmBD1SI3HMCk2OEtxLHXCxlTJ8Yd+ryfP6pjH2Z2hP/MVaN17UdUOiZKck=; session-token=oUrlODb8ysnFCmUk3y7mNLN48nWgMtxwalqNl6/9lWcfO9NG2AsVlMGSLn0vlPPU6LT/LKeBGRm0LOrDukGPhZ3pyTmTg/WNIp99fTHtPAZN1ixKCI1rBD8RowwdLLXbeaSR/uLP2Xi0iB349q1FdnaaiVR7I4JxgTH3EYOjjsN78tpA10vTTkHLNdtDL8oz; skin=noskin");
    if ($html){
        $pattern = '/<li id=(.*?) data-result-rank=(.*?) data-asin=(.*?) sx-detail-display-trigger s-result-item s-result-card-for-container a-declarative celwidget ">/si';
        preg_match_all($pattern,$html,$results);
        print_r($results);
    }else{
        echo "页面获取失败！";
    }
}catch (Exception $e){
    echo 'Message:'.$e->getMessage();
}