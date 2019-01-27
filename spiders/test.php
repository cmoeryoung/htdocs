<?php
/**
 * Created by PhpStorm.
 * User: Cmoer
 * Date: 2019/1/27
 * Time: 14:33
 */
require_once __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

run();
function run()
{
    //要爬取的页面地址为我的博客园主页
    $url = "https://www.amazon.com";
    //伪造浏览器UA
    $headers = [
        'user-agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36',
    ];
    $client = new Client([
        'timeout' => 20,
        'headers' => $headers
    ]);
    //发送请求获取页面内容
    $response = $client->request('GET', $url)->getBody()->getContents();

    $data = [];
    $crawler = new Crawler();
    $crawler->addHtmlContent($response);

    print_r($crawler);

    //使用crawler进行页面内容分析
    try{
        //这里使用的是xpath语法，轮询forFlow子类day中的元素，既页面上每一篇文章的块状元素，并且进行内容获取
        $crawler->filterXPath('//div[contains(@class, "forFlow")]/div[contains(@class, "day")]')->each(function(Crawler $node, $i) use (&$data){
            $item = [
                'date' => $node->filterXPath('//div[contains(@class, "dayTitle")]/a')->text(),
                'title' => $node->filterXPath('//div[contains(@class, "postTitle")]/a')->text(),
                'abstract' => $node->filterXPath('//div[contains(@class, "postCon")]/div')->text(),
                'url' => $node->filterXPath('//div[contains(@class, "postCon")]/div/a')->attr('href'),
            ];
            $data[] = $item;
        });
    }catch (\Exception $e){
        echo $e->getMessage() . PHP_EOL;
    }
    //打印结果
    print_r($data);
}