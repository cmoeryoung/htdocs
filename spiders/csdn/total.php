<?php
/**
 * User: cmoer
 * Date: 2019-02-14
 * Time: 00:58
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

$sql = "select cid,url from category where pid != 0";
$rs = $mysqli->query($sql);
if ($rs->num_rows > 0){
    while ($row = $rs->fetch_assoc()){
//        print_r($row);
        $cid = $row['cid'];
        $url = $row['url'];

        $str = get_str($url);

        $rule = '/<A href=.*?#page=(.*?) class=menu8>尾页<\/A>/si';
        preg_match_all($rule,$str,$totals);
        if (!empty($totals)){
            $yeshu = $totals[1];
//            echo $yeshu;
            $sql = "update category set yeshu={$yeshu} where cid={$cid}";
            $mysqli->query($sql);
            if ($mysqli->affected_row > 0){
                echo 'Update Success';
            }else{
                echo 'Update Falied';
                echo $mysqli->error.'<br>';
                echo $sql;
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