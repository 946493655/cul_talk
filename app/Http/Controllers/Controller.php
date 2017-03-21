<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Api\ApiTalk\ApiTopic;
use Illuminate\Support\Facades\View;
use Session;
use Redis;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    protected $limit = 20;
    protected $redisTime = 60 * 60 * 2;       //session在redis中缓存时长，单位秒，默认2小时
    protected $uploadSizeLimit = 1024 * 1023 * 1;       //限制上传大小1M
    protected $suffix_img = [       //图片允许后缀
        "png", "jpg", "gif", "bmp", "jpeg", "jpe",
    ];

    public function __construct()
    {
        define('DOMAIN',env('DOMAIN'));
        define('PUB',env('PUB'));
        View::share('navs',$this->getNavigates());      //共享菜单数据
        $this->setSessionInRedis($this->redisTime);     //同步缓存中session
    }

    /**
     * 前台横向菜单栏共享数据
     */
    public function getNavigates()
    {
        $apiNav = ApiTopic::index(5);
        return $apiNav['code']==0 ? $apiNav['data'] : [];
    }

    /**
     * 判断session、缓存
     */
    public function setSessionInRedis($redisTime)
    {
        //假如session中有，缓存中没有，则同步为有
        if (Session::get('user') && !Redis::get('cul_session')) {
            $userInfo = Session::get('user');
            $userInfo['cookie'] = $_COOKIE;
            Redis::setex('cul_session',$redisTime,serialize($userInfo));
        }
        //假如session中没有，缓存中有，则同步为有
        if (!Session::get('user') && Redis::get('cul_session')) {
            $cul_session = unserialize(Redis::get('cul_session'));
            $cul_session['cookie'] = $_COOKIE;
            if ($cul_session['cookie']['laravel_session']!=$_COOKIE['laravel_session']) {
                echo 'no';exit;
            }
            Session::put('user',$cul_session);
        }
        //更新session中的cookie值
        if (Session::get('user')) {
            $cul_session = Session::get('user');
            $cul_session['cookie'] = $_COOKIE;
            Redis::setex('cul_session',$redisTime,serialize($cul_session));
            Session::put('user',$cul_session);
        }
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

    /**
     * 上传方法，并处理文件
     */
    public function upload($file)
    {
        if($file->isValid()){
            $allowed_extensions = $this->suffix_img;
            if ($file->getClientOriginalExtension() &&
                !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
                echo "<script>alert('你的图片格式不对！');history.go(-1);</script>";exit;
            }
            $extension       = $file->getClientOriginalExtension() ?: 'png';
            $folderName      = '/uploads/images/'.date('Y-m-d', time()).'/';
            $destinationPath = public_path().$folderName;
            $safeName        = uniqid().'.'.$extension;
            $file->move($destinationPath, $safeName);
            $filePath = rtrim(DOMAIN,'/').$folderName.$safeName;
            return $filePath;
        } else {
            return "没有图片！";
        }
    }

    /**
     * 只上传图片，返回图片地址
     */
    public function uploadOnlyImg(Request $request,$imgName='url_ori',$oldImgArr=[])
    {
        if($request->hasFile($imgName)){        //判断图片存在
            //去除老图片
            if ($oldImgArr) {
                foreach ($oldImgArr as $oldImg) { unlink($oldImg); }
            }
            foreach ($_FILES as $img) {
                if ($img['size'] > $this->uploadSizeLimit) {
                    echo "<script>alert('上传的图片不能大于1M，请重新选择！');history.go(-1);</script>";exit;
                }
            }
            $file = $request->file($imgName);           //获取图片
            return $this->upload($file);
        } else {
            return '';
        }
    }
}
