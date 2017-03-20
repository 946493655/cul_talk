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
        //获取积分交易接受人uid
        $apiIntegral = ApiIntegral::getOneByTalkid($talkid);
        $integral = $apiIntegral['code']==0 ? $apiIntegral['data'] : [];
        $result = [
            'datas' =>  $datas,
            'pagelist'      =>  $pagelist,
            'prefix_url'    =>  $prefix_url,
            'talks'     =>  $talks,
            'talkid'    =>  $talkid,
            'integral'  =>  $integral,
        ];
        return view('member.reply.index', $result);
    }

    public function addReply()
    {
        $topic_id = $_GET['topic_id'];
        $talkid = $_GET['talkid'];
        $reply = $_GET['reply'];
        if (!Session::has('user') || !$topic_id || !$talkid || !$reply) {
            echo "<script>alert('数据错误！');history.go(-1);</script>";exit;
        }
        $data = [
            'uid'   =>  Session::get('user.uid'),
            'talkid'    =>  $talkid,
            'intro'     =>  $reply,
        ];
        $apiComment = ApiComment::add($data);
        if ($apiComment['code']!=0) {
            echo "<script>alert('".$apiComment['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'t/'.$topic_id.'/talk/'.$talkid);
    }

    /**
     * 中意某一回复
     */
    public function getUser($talkid,$uid)
    {
        $apiIntegral = ApiIntegral::setUser($talkid,$uid);
        if ($apiIntegral['code']!=0) {
            echo "<script>alert('".$apiIntegral['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/reply');
    }
}