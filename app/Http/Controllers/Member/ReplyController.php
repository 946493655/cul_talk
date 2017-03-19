<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiTalk\ApiIntegral;
use App\Api\ApiTalk\ApiTalk;
use Session;
use App\Api\ApiTalk\ApiComment;

class ReplyController extends BaseController
{
    /**
     * 回复
     */

    public function index($talkid=0)
    {
        $uid = Session::get('user.uid');
        $pageCurr = isset($_GET['pageCurr']) ? $_GET['pageCurr'] : 1;
        $prefix_url = DOMAIN.'account/reply';
        $apiComment = ApiComment::index($this->limit,$pageCurr,$talkid,$uid);
        if ($apiComment['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiComment['data']; $total = $apiComment['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        //获取我的话题
        $apiTalk = ApiTalk::index(10000,1,0,0,$uid);
        $talks = $apiTalk['code']==0 ? $apiTalk['data'] : [];
        $result = [
            'datas' =>  $datas,
            'pagelist'      =>  $pagelist,
            'prefix_url'    =>  $prefix_url,
            'talks'     =>  $talks,
            'talkid'    =>  $talkid,
        ];
        return view('member.reply.index', $result);
    }

    /**
     * 中意某一回复
     */
    public function getUser($talkid,$uid)
    {
        $apiIntegral = ApiIntegral::setUser();
    }
}