<?php
/**
 * User: cmoer
 * Date: 2019-02-14
 * Time: 01:40
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

$sql = "select cid,url,yeshu from category where pid != 0";
$rs = $mysqli->query($sql);
if ($rs->num_rows > 0){
    while ($row=$rs->fetch_assoc()){
//        print_r($row);
        $yeshu = $row['yeshu'];
        $url = $row['url'];
        $pre = substr($url,0,-6);
//        print_r($pre);
//        exit();

        for ($i=1;$i<=$yeshu;++$i){
            $url = $pre.$i.'.html';
//            echo $url;

            $str = get_str($url);
            $block_rule = '/<div id="content">(.*?)<DIV id=sg3><\/DIV>/si';
            preg_match($block_rule,$str,$result);
            if (!empty($result)){
                $content_url_rule = '/<a href="(.*?)" target="_blank">/si';
                preg_match_all($content_url_rule,$result[1],$content_urls);
                if (!empty($content_urls)){
                    $count = count($content_urls[1]);
                    for ($j=1;$j<$count;++$j){
                        $url = 'http://qiye.youboy.com'.$content_urls[1][$j];
                        $sql = "insert into content (url) values ('{$url}')";
                        $mysqli->query($sql);
                        if ($mysqli->affected_rows >0){
                            echo 'Insert content url success';
                        }else{
                            echo 'Insert content url failed.<br>';
                            echo $mysqli->connect_error,'<br>';
                            echo $sql;
                        }
                    }
                }
            }
        }
    }

    $rs->free();
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