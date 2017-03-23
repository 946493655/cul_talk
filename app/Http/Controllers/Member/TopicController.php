<?php
namespace App\Http\Controllers\Member;

use Session;
use App\Api\ApiTalk\ApiTopic;

class TopicController extends BaseController
{
    /**
     * 专栏
     */

    /**
     * 我的专栏
     */
    public function index()
    {
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $prefix_url = DOMAIN.'account/topic';
        $apiTopic = ApiTopic::index($this->limit,$pageCurr,Session::get('user.uid'));
        if ($apiTopic['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiTopic['data']; $total = $apiTopic['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas'  =>  $datas,
            'pagelist'  =>  $pagelist,
            'prefix_url'  =>  $prefix_url,
        ];
        return view('member.topic.index', $result);
    }
}