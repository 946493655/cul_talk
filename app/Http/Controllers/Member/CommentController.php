<?php
namespace App\Http\Controllers\Member;

use Session;
use App\Api\ApiTalk\ApiComment;

class CommentController extends BaseController
{
    /**
     * 评论
     */

    /**
     * 我的类别
     */
    public function index()
    {
        $pageCurr = isset($_GET['pageCurr']) ? $_GET['pageCurr'] : 1;
        $prefix_url = DOMAIN.'account/comment';
        $apiComment = ApiComment::index($this->limit,$pageCurr,0,Session::get('user.uid'));
        if ($apiComment['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiComment['data']; $total = $apiComment['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas'  =>  $datas,
            'pagelist'  =>  $pagelist,
            'prefix_url'  =>  $prefix_url,
        ];
        return view('member.comment.index', $result);
    }
}