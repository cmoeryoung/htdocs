<?php
$urls = array(
    'http://www.sina.com.cn/',
    'http://www.sohu.com/',
    'http://www.163.com/'
); // 设置要抓取的页面URL

$save_to='/test.txt';   // 把抓取的代码写入该文件

$st = fopen($save_to,"a");
$mh = curl_multi_init();

foreach ($urls as $i => $url) {
    $conn[$i] = curl_init($url);
    curl_setopt($conn[$i], CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
    curl_setopt($conn[$i], CURLOPT_HEADER ,0);
    curl_setopt($conn[$i], CURLOPT_CONNECTTIMEOUT,60);
    curl_setopt($conn[$i], CURLOPT_FILE,$st); // 设置将爬取的代码写入文件
    curl_multi_add_handle ($mh,$conn[$i]);
} // 初始化

do {
    curl_multi_exec($mh,$active);
} while ($active);  // 执行

foreach ($urls as $i => $url) {
    curl_multi_remove_handle($mh,$conn[$i]);
    curl_close($conn[$i]);
} // 结束清理

curl_multi_close($mh);
fclose($st);
?>