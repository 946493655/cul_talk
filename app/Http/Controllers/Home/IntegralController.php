<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiTalk\ApiIntegral;
use App\Api\ApiTalk\ApiParam;
use Session;
use Illuminate\Http\Request;

class IntegralController extends BaseController
{
    /**
     * 论坛积分
     */

    /**
     * 添加要交易的积分
     */
    public function store(Request $request)
    {
        if (!Session::has(('user'))) {
            echo "<script>alert('未登陆！');history.go(-1);</script>";exit;
        }
        $uid = Session::get('user.uid');
        if (!$request->talkid || !$request->number) {
            echo "<script>alert('数据错误！');history.go(-1);</script>";exit;
        }
        $apiParam = ApiParam::show($uid);
        if ($apiParam['code']!=0 || ($apiParam['code']==0&&!$apiParam['data']['integral']) || ($apiParam['code']==0&&$apiParam['data']['integral']<$request->number)) {
            echo "<script>alert('积分不足！');history.go(-1);</script>";exit;
        }
        $data = [
            'uid'   =>  $uid,
            'talkid'    =>  $request->talkid,
            'number'    =>  $request->number,
        ];
        $apiIntegral = ApiIntegral::add($data);
        if ($apiIntegral['code']!=0) {
            echo "<script>alert('".$apiIntegral['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'account/talk');
    }
}