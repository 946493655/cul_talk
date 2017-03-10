<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Api\ApiTalk\ApiTopic;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    /**
     * 前台基础控制器
     */

    public function __construct()
    {
        parent::__construct();
        View::share('navs',$this->getNavigates());      //共享菜单数据
    }

    /**
     * 前台横向菜单栏共享数据
     */
    public function getNavigates()
    {
        $apiNav = ApiTopic::getTopicsByLimit(5);
        return $apiNav['code']==0 ? $apiNav['data'] : [];
    }
}