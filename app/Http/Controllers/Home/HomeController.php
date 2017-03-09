<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiTalk\ApiTopic;

class HomeController extends BaseController
{
    /**
     * 前台首页
     */

    public function index()
    {
        $result = [
            'topics'    =>  $this->getTopics(5),
        ];
        dd($this->getTopics(5));
        return view('home.home.index', $result);
    }

    /**
     * 获取专栏
     */
    public function getTopics($limit)
    {
        $apiTopic = ApiTopic::index($limit,1);
        return $apiTopic['code']==0 ? $apiTopic['data'] : [];
    }
}