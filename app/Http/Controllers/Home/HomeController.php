<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiTalk\ApiCate;

class HomeController extends BaseController
{
    /**
     * 前台首页
     */

    public function index()
    {
        $result = [
            //获取自由话题类别
            'cate1s' => $this->getCates(3,1),
            //获取图形软件类别
            'cate2s' => $this->getCates(3,2),
            //获取视频作品类别
            'cate3s' => $this->getCates(3,3),
            //获取网站设计类别
            'cate4s' => $this->getCates(3,4),
            //获取人生足迹类别
            'cate5s' => $this->getCates(3,5),
        ];
        return view('home.home.index', $result);
    }

    public function getCates($limit,$topic)
    {
        $apiCate = ApiCate::getCatesByLimit($limit,$topic);
        return $apiCate['code']==0 ? $apiCate['data'] : [];
    }
}