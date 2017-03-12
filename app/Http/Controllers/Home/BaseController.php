<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Api\ApiTalk\ApiTopic;
use Illuminate\Support\Facades\View;
use Session;
use Redis;

class BaseController extends Controller
{
    /**
     * 前台基础控制器
     */

    public function __construct()
    {
        parent::__construct();
        View::share('navs',$this->getNavigates());      //共享菜单数据
        $this->setSessionInRedis($this->redisTime);     //同步缓存中session
    }

    /**
     * 前台横向菜单栏共享数据
     */
    public function getNavigates()
    {
        $apiNav = ApiTopic::getTopicsByLimit(5);
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
}