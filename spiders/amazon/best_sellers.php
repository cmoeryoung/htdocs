<?php
/**
 * User: Cmoer
 * Date: 2/14/2019
 * Time: 10:20 AM
 */
require_once 'C:\MAMP\htdocs\spiders\get_str.php';

header('Content-Type:text/html;charset=UTF-8');
set_time_limit(10); //超时设置
ini_set('memory_limit','1024M');    //设置php运行时内存

$mysqli = new mysqli('localhost','root','yhx1014','amazon')
    or die($mysqli->connect_error);
if ($mysqli->errno > 0){
    echo 'Database Connected Error.<br>';
    echo $mysqli->errno;
    exit();
}
$mysqli->query('set names utf8');   //设置数据库请求时的编码，防乱码

$url = 'https://www.amazon.com/gp/bestsellers/hpc/13106351';
$rs = get_str($url);
//print_r($rs);
$contents_rule = '/<div id="zg-right-col".*?>(.*?)<\/a><\/li><\/ul><\/div><\/div>.*?<\/div>/si';
preg_match_all($contents_rule,$rs,$contents);
if (!empty($contents)){
//    print_r($contents[1]);
    $count = count($contents[1]);
    for ($i=0;$i<$count;++$i){
        $category_rule = '/<span class="category">(.*?)<\/span>/si';
        preg_match($category_rule,$contents[1][$i],$categorys);
//        $category = $categorys[1];
//        print_r($category);

        $rank_rule = '/<span class="zg-badge-text">#(.*?)<\/span>/si';
        preg_match($rank_rule,$categorys[1][$i],$ranks);
//        $rank = $ranks[1];

        $main_img_url_rule = '/<img alt="(.*?)" src="(.*?)" width="200" height="200">/si';
        preg_match($main_img_url_rule,$categorys[1][$i],$img_title);
//        $title = $img_title[1];
//        $main_img_url = $img_title[2];

        $star_rule = '/<span class="a-icon-alt">(.*?) out of 5 stars<\/span>/si';
        preg_match($star_rule,$categorys[1][$i],$stas);
//        $star = $stars[1];

        $reviews_num_rule = '/<a class="a-size-small a-link-normal".*?>(.*?)<\/a>/si';
        preg_match($reviews_num_rule,$categorys[1][$i],$reviews_nums);
//        $reviews_num = $reviews_nums[1];

        $price_rule = '/<span class="p13n-sc-price">(.*?)<\/span>/si';
        preg_match($price_rule,$categorys[1][$i],$prices);
//        $price = $prices[1];

//        echo $category,$rank,$title,$main_img_url,$star,$reviews_num,$price,'<br>';

//        $sql = "insert into table amazon_test (category,rank,title,main_img_url,start,review_num,price)
//            values ('$categorys[1]','$ranks[1]','$img_title[1]','$img_title[2]','$stars[1]','$reviews_nums[1]','$prices[1]')";
//        $rs = $mysqli->query($sql);
//        if ($rs->num_rows > 0){
//            echo 'Insert Data Success';
//        }else{
//            echo 'Insert Data Failed';
//        }




    }
}

$mysqli->close();   //关闭数据库