<?php
namespace App\Http\Controllers\Member;

use Session;
use App\Api\ApiTalk\ApiTalk;

class AwardController extends BaseController
{
    /**
     * 奖励
     */

    /**
     * 积分奖励记录
     */
    public function index()
    {
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
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
        return view('member.award.index', $result);
    }
}