<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiTalk\ApiCate;
use App\Api\ApiTalk\ApiComment;
use App\Api\ApiTalk\ApiParam;
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
        $uid = Session::get('user.uid');
        //获取我的专栏
        $apiTopic = ApiTopic::index(10000,1,$uid);
        $apiCate = ApiCate::index(10000,1,0,$uid);
        $apiTalk = ApiTalk::index(10000,1,0,0,$uid);
        $apiComment = ApiComment::index(10000,1,0,$uid);
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
            'param' => $apiParam['data'],
        ];
        return view('member.user.index', $result);
    }

    /**
     * 我的专栏
     */
    public function getTopicList()
    {
        $pageCurr = isset($_GET['pageCurr']) ? $_GET['pageCurr'] : 1;
        $prefix_url = DOMAIN.'account/topic';
        $apiTopic = ApiTopic::index($this->limit,$pageCurr,Session::get('user.uid'));
        if ($apiTopic['code']!=0) {
            echo "<script>alert('".$apiTopic['msg']."');history.go(-1);</script>";exit;
        }
        $pagelist = $this->getPageList($apiTopic['pagelist']['total'],$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas'  =>  $apiTopic['data'],
            'pagelist'  =>  $pagelist,
            'prefix_url'  =>  $prefix_url,
        ];
        return view('member.user.listTopic', $result);
    }

    /**
     * 我的类别
     */
    public function getCateList()
    {
        $pageCurr = isset($_GET['pageCurr']) ? $_GET['pageCurr'] : 1;
        $prefix_url = DOMAIN.'account/cate';
        $apiCate = ApiCate::index($this->limit,$pageCurr,0,Session::get('user.uid'));
        if ($apiCate['code']!=0) {
            echo "<script>alert('".$apiCate['msg']."');history.go(-1);</script>";exit;
        }
        $pagelist = $this->getPageList($apiCate['pagelist']['total'],$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas'  =>  $apiCate['data'],
            'pagelist'  =>  $pagelist,
            'prefix_url'  =>  $prefix_url,
        ];
        return view('member.user.listCate', $result);
    }

    /**
     * 我的类别
     */
    public function getTalkList()
    {
        $pageCurr = isset($_GET['pageCurr']) ? $_GET['pageCurr'] : 1;
        $prefix_url = DOMAIN.'account/talk';
        $apiTalk = ApiTalk::index($this->limit,$pageCurr,0,0,Session::get('user.uid'));
        if ($apiTalk['code']!=0) {
            echo "<script>alert('".$apiTalk['msg']."');history.go(-1);</script>";exit;
        }
        $pagelist = $this->getPageList($apiTalk['pagelist']['total'],$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas'  =>  $apiTalk['data'],
            'pagelist'  =>  $pagelist,
            'prefix_url'  =>  $prefix_url,
        ];
        return view('member.user.listTalk', $result);
    }

    /**
     * 我的类别
     */
    public function getCommentList()
    {
        $pageCurr = isset($_GET['pageCurr']) ? $_GET['pageCurr'] : 1;
        $prefix_url = DOMAIN.'account/comment';
        $apiComment = ApiComment::index($this->limit,$pageCurr,0,Session::get('user.uid'));
        if ($apiComment['code']!=0) {
            echo "<script>alert('".$apiComment['msg']."');history.go(-1);</script>";exit;
        }
        $pagelist = $this->getPageList($apiComment['pagelist']['total'],$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas'  =>  $apiComment['data'],
            'pagelist'  =>  $pagelist,
            'prefix_url'  =>  $prefix_url,
        ];
        return view('member.user.listComment', $result);
    }

    /**
     * 积分奖励记录
     */
    public function getAwardList()
    {
        $pageCurr = isset($_GET['pageCurr']) ? $_GET['pageCurr'] : 1;
        $prefix_url = DOMAIN.'account/award';
        $apiTalk = ApiTalk::index($this->limit,$pageCurr,0,0,Session::get('user.uid'));
        if ($apiTalk['code']!=0) {
            echo "<script>alert('".$apiTalk['msg']."');history.go(-1);</script>";exit;
        }
        $pagelist = $this->getPageList($apiTalk['pagelist']['total'],$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas'  =>  $apiTalk['data'],
            'pagelist'  =>  $pagelist,
            'prefix_url'  =>  $prefix_url,
        ];
        return view('member.user.listAward', $result);
    }

    /**
     * 积分交易记录
     */
    public function getIntegralList()
    {
        $pageCurr = isset($_GET['pageCurr']) ? $_GET['pageCurr'] : 1;
        $prefix_url = DOMAIN.'account/integral';
//        $apiTalk = ApiTalk::index($this->limit,$pageCurr,0,0,Session::get('user.uid'));
        if ($apiTalk['code']!=0) {
            echo "<script>alert('".$apiTalk['msg']."');history.go(-1);</script>";exit;
        }
        $pagelist = $this->getPageList($apiTalk['pagelist']['total'],$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas'  =>  $apiTalk['data'],
            'pagelist'  =>  $pagelist,
            'prefix_url'  =>  $prefix_url,
        ];
        return view('member.user.listAward', $result);
    }
}