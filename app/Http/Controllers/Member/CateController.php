<?php
namespace App\Http\Controllers\Member;

use Session;
use App\Api\ApiTalk\ApiCate;

class CateController extends BaseController
{
    /**
     * 类别
     */

    /**
     * 我的类别
     */
    public function index()
    {
        $pageCurr = isset($_GET['pageCurr']) ? $_GET['pageCurr'] : 1;
        $prefix_url = DOMAIN.'account/cate';
        $apiCate = ApiCate::index($this->limit,$pageCurr,0,Session::get('user.uid'));
        if ($apiCate['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiCate['data']; $total = $apiCate['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas'  =>  $datas,
            'pagelist'  =>  $pagelist,
            'prefix_url'  =>  $prefix_url,
        ];
        return view('member.cate.index', $result);
    }
}