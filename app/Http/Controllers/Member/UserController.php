<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiTalk\ApiCate;
use App\Api\ApiTalk\ApiComment;
use App\Api\ApiTalk\ApiParam;
use App\Api\ApiTalk\ApiTalk;
use App\Api\ApiTalk\ApiTalkClick;
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
        $uid = Session::get('user.uid');
        //获取我的专栏
        $apiTopic = ApiTopic::index(10000,1,$uid);
        $apiCate = ApiCate::index(10000,1,0,$uid);
        $apiTalk = ApiTalk::index(10000,1,0,0,$uid);
        $apiComment = ApiComment::index(10000,1,0,$uid);
        $apiClick = ApiTalkClick::index(10000,1,0,$uid);
        $apiParam = ApiParam::show($uid);
        if ($apiParam['code']!=0) {
            echo "<script>alert('".$apiParam['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'userInfo' => $userArr,
            'topics' => $apiTopic['code']==0 ? $apiTopic['data'] : [],
            'cates' => $apiCate['code']==0 ? $apiCate['data'] : [],
            'talks' => $apiTalk['code']==0 ? $apiTalk['data'] : [],
            'comments' => $apiComment['code']==0 ? $apiComment['data'] : [],
            'clicks' => $apiClick['code']==0 ? $apiClick['data']: [],
            'param' => $apiParam['data'],
        ];
        return view('member.user.index', $result);
    }
}