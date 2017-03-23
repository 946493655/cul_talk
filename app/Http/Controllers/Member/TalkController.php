<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiTalk\ApiTalkClick;
use Session;
use App\Api\ApiTalk\ApiTalk;
use App\Api\ApiTalk\ApiParam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as AjaxRequest;

class TalkController extends BaseController
{
    /**
     * 话题
     */

    /**
     * 我的类别
     */
    public function index()
    {
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $prefix_url = DOMAIN.'account/talk';
        $apiTalk = ApiTalk::index($this->limit,$pageCurr,0,0,Session::get('user.uid'));
        if ($apiTalk['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiTalk['data']; $total = $apiTalk['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        //获取该用户积分总数
        $apiParam = ApiParam::show(Session::get('user.uid'));
        $userParam = $apiParam['code']==0 ? $apiParam['data'] : [];
        $result = [
            'datas'  =>  $datas,
            'pagelist'  =>  $pagelist,
            'prefix_url'  =>  $prefix_url,
            'param'     =>  $userParam,
        ];
        return view('member.talk.index', $result);
    }

    public function show($id)
    {
        $apiTalk = ApiTalk::show($id);
        if ($apiTalk['code']!=0) {
            echo "<script>alert('".$apiTalk['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'  =>  $apiTalk['data'],
        ];
        return view('member.talk.show', $result);
    }

    /**
     * 设置缩略图
     */
    public function setThumb(Request $request,$id)
    {
        $oldImgArr = array();
        $apiTalk = ApiTalk::show($id);
        if ($apiTalk['code']==0 && $apiTalk['data']['thumb']) {
            $oldImgArr[] = $apiTalk['data']['thumb'];
        }
        $thumb = $this->uploadOnlyImg($request,'url_ori',$oldImgArr);
        $data = [
            'id'    =>  $id,
            'thumb' =>  $thumb,
        ];
        $apiTalk2 = ApiTalk::setThumb($data);
        if ($apiTalk2['code']!=0) {
            echo "<script>alert('".$apiTalk2['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/talk');
    }

    /**
     * ajax更新点赞
     */
    public function setPraise(Request $request)
    {
        if (AjaxRequest::ajax()) {
            $id = $request->id;
            $uid = $request->uid;
            $apiClick = ApiTalkClick::add($id,$uid);
            if ($apiClick['code']!=0) {
                echo json_encode(array('code'=>-2,'msg'=>$apiClick['msg']));exit;
            }
            echo json_encode(array('code'=>0,'msg'=>'操作成功！'));exit;
        }
        echo json_encode(array('code'=>-1,'msg'=>'参数错误！'));exit;
    }

    /**
     * 点赞列表
     */
    public function getClickList($talkid=0)
    {
        $uid = Session::get('user.uid');
        $pageCurr = isset($_GET['pageCurr']) ? $_GET['pageCurr'] : 1;
        $prefix_url = DOMAIN.'member/talk/click';
        $apiClick = ApiTalkClick::index($this->limit,$pageCurr,$talkid,$uid);
        if ($apiClick['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiClick['data']; $total = $apiClick['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        //获取我的话题
        $apiTalk = ApiTalk::index(10000,1,0,0,$uid);
        $talks = $apiTalk['code']==0 ? $apiTalk['data'] : [];
        $result = [
            'datas'  =>  $datas,
            'prefix_url'    =>  $prefix_url,
            'pagelist'  =>  $pagelist,
            'talks'     =>  $talks,
            'talkid'    =>  $talkid,
        ];
        return view('member.talk.clickList', $result);
    }
}