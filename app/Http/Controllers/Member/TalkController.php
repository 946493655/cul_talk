<?php
namespace App\Http\Controllers\Member;

use Session;
use App\Api\ApiTalk\ApiTalk;
use App\Api\ApiTalk\ApiParam;

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
        $pageCurr = isset($_GET['pageCurr']) ? $_GET['pageCurr'] : 1;
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
}