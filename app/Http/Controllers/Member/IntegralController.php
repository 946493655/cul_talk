<?php
namespace App\Http\Controllers\Member;

use Session;
use App\Api\ApiTalk\ApiIntegral;

class IntegralController extends BaseController
{
    /**
     * 积分交易
     */

    /**
     * 积分交易记录
     */
    public function index($genre=1)
    {
        $uid = Session::get('user.uid');
        $pageCurr = isset($_GET['pageCurr']) ? $_GET['pageCurr'] : 1;
        $prefix_url = DOMAIN.'account/integral';
        $apiIntegral = ApiIntegral::index($this->limit,$pageCurr,0,$uid,$genre);
        if ($apiIntegral['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiIntegral['data']; $total = $apiIntegral['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas'     =>  $datas,
            'pagelist'  =>  $pagelist,
            'prefix_url'  =>  $prefix_url,
        ];
        return view('member.integral.index', $result);
    }
}