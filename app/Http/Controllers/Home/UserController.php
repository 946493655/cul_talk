<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiTalk\ApiCate;
use App\Api\ApiTalk\ApiTalk;
use App\Api\ApiTalk\ApiTopic;
use App\Api\ApiUser\ApiUsers;
use Session;

class userController extends BaseController
{
    /**
     * 用户信息
     */
    public function index()
    {
        $userArr = Session::get('user');
        $apiUser = ApiUsers::getOneUser(Session::get('user.uid'));
        $userArr['userType'] = $apiUser['data']['userType'];
        $result = [
            'userInfo' => $userArr,
            'topics' => $this->getTopics(),
            'cates' => $this->getCates(),
            'talks' => $this->getTalks(),
        ];
        return view('member.user.index', $result);
    }

    /**
     * 获取我的专栏
     */
    public function getTopics()
    {
        $apiTopic = ApiTopic::index(10000,1,Session::get('user.uid'));
        return $apiTopic['code']==0 ? $apiTopic['data'] : [];
    }

    /**
     * 获取我的类别
     */
    public function getCates()
    {
        $apiTopic = ApiCate::index(10000,1,0,Session::get('user.uid'));
        return $apiTopic['code']==0 ? $apiTopic['data'] : [];
    }

    /**
     * 获取我的话题
     */
    public function getTalks()
    {
        $apiTopic = ApiTalk::index(10000,1,0,0,Session::get('user.uid'));
        return $apiTopic['code']==0 ? $apiTopic['data'] : [];
    }
}