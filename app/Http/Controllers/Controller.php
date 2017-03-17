<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    protected $limit = 20;
    protected $redisTime = 60 * 60 * 2;       //session在redis中缓存时长，单位秒，默认2小时

    public function __construct()
    {
        define('DOMAIN',env('DOMAIN'));
        define('PUB',env('PUB'));
    }

    /**
     * 接口分页处理
     */
    public function getPageList($total,$prefix_url,$limit,$pageCurr=1)
    {
        $currentPage = $pageCurr;                               //当前页
        $lastPage = ($pageCurr - 1) ? ($pageCurr - 1) : 1;      //上一页
        //上一页路由
        if ($pageCurr<=1) {
            $previousPageUrl = $prefix_url;
        } else {
            $previousPageUrl = $prefix_url.'?page='.($pageCurr-1);
        }
        //下一页路由
        if ($total <= $limit) {
            $nextPageUrl = $prefix_url;
        } elseif ($pageCurr * $limit >= $total) {
            $nextPageUrl = $prefix_url.'?page='.$pageCurr;
        } else {
            $nextPageUrl = $prefix_url.'?page='.($pageCurr+1);
        }
        return array(
            'currentPage'   =>  $currentPage,
            'lastPage'      =>  $lastPage,
            'total'         =>  $total,
            'limit'         =>  $limit,
            'previousPageUrl'   =>  $previousPageUrl,
            'nextPageUrl'   =>  $nextPageUrl,
        );
    }

    /**
     * 定义一个方法，获取用户端ip
     */
    public function getIp()
    {
        if (getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } else if (getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("REMOTE_ADDR")) {
            $ip = getenv("REMOTE_ADDR");
        } else {
            $ip = "";
        }
        return $ip;
    }

    /**
     * 由ip获得所在城市
     */
    public function getCityByIp($ip='')
    {
        $address = '';
        if ($ip && substr($ip,0,7)!='192.168') {
            $key = 'Tj1ciyqmG0quiNgpr0nmAimUCCMB5qMk';      //自己申请的百度地图api的key
            $curl = new \Curl\Curl();
            $apiUrl = 'http://api.map.baidu.com/location/ip';
            $curl->post($apiUrl, array(
                'ak'=> $key,
                'ip'=> $ip,
            ));
            $response = $curl->response;
            $response = json_decode(json_encode($response),true);
            if ($response['status']==0) {
                $address = $response['content']['address'];
            }
        } elseif ($ip && substr($ip,0,7)=='192.168') {
            $address = '浙江省 杭州市 滨江区';
        } elseif (!$ip) {
            $address = '未知';
        }
        return $address;
    }
}
