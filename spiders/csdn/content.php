<?php
/**
 * User: cmoer
 * Date: 2019-02-14
 * Time: 02:10
 */
header('Content-Type:text/html;charset=UTF-8');
set_time_limit(0);  //设置php运行时间为不限制
ini_set('memory_limit','200M');    //设置php运行时内存

$mysqli = new mysqli('localhost','root','yhx1014','qiye');
if ($mysqli->connect_errno > 0){
    $mysqli->connect_errno;
    exit;
}
$mysqli->query('set names utf8');

$sql = "select url from content limit 1";
$rs = $mysqli->query($sql);
if ($rs->num_rows > 0){
    while ($row = $rs->fetch_assoc()){
        $url = $row['url'];
        $str = get_str($url);
        $block = '/<div class="gsinfocon">(.*?)<div class="gslxts">联系时请告知该信息来自一呼百应B2B搜索引擎<\/div>/si';

    }
}

$mysqli->close();
/**
 * @param $url
 * @return mixed
 * curl获取网页内容
 */
function get_str($url){
    $ch = curl_init($url);
    //设置curl相关选项
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  //返回网页内容
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10); //超时设置，10s
    $str = curl_exec($ch);
    curl_close($ch);
    return $str;
}