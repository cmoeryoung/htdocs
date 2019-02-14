<?php
/**
 * User: cmoer
 * Date: 2019-02-13
 * Time: 22:55
 */

/**
 * 获取一级分类，二级分类的名称和对应url
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

$url = 'http://qiye.youboy.com/';
$str = get_str($url);
//echo $str;
/**
 * 获取一级分类，二级分类
 */
$block_rule = '/<DIV id=hy_middle_connect_ul_title_daohang>(.*?)<\/UL>.*?<\/DIV>.*?<\/DIV>/si';   //s,包含换行空白。i,忽略大小写
preg_match_all($block_rule,$str,$fenleis);
if (!empty($fenleis)){
//    print_r($fenleis[1]);
    $count = count($fenleis[1]);
    for ($i = 0;$i < $count;++$i){
        $cat_rule = '/<A.*?href="(.*?)".*?>(.*?)<\/A>/si';
        preg_match_all($cat_rule,$fenleis[1][$i],$cats);
        if (!empty($cats)){
//            print_r($cats[1]);
//            print_r($cats[2]);

            //一级分类插入数据库
            $url = 'http://qiye.youboy.com'.$cats[1][0];
            $fenlei1 = $cats[2][0];

//            echo $url.'<br>';
//            echo $fenlei1.'<br>';

            $sql = "insert into category(fenlei1,url) values ('{$fenlei1}','{$url}')";
            $mysqli->query($sql);

            if ($mysqli->insert_id > 0){
                $pid = $mysqli->insert_id;

                $c_num = count($cats[1]);
                for ($j = 1;$j < $c_num;++$j){
                    $fenlei2 = $cats[2][$j];
                    $fenlei2_url = 'http://qiye.youboy.com'.$cats[1][$j];

                    $sql = "insert into category(fenlei2,url,pid) values ('{$fenlei2}','{$fenlei2_url}','{$pid}')";
                    $mysqli->query($sql);

                    if ($mysqli->affected_rows > 0){
                        echo 'Sub-Category Insert Success. <br>';
                    }else{
                        echo 'Sub-Category Insert Failed. <br>';
                        echo $mysqli->error.'<br>';
                        echo $sql;
                    }
                }
            }else{
                echo 'Category Insert Failed. <br>';
                echo $mysqli->error.'<br>';
                echo $sql;
            }
        }
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