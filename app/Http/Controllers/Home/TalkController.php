<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiTalk\ApiCate;
use App\Api\ApiTalk\ApiTalk;
use App\Api\ApiTalk\ApiTopic;
use Session;
use Illuminate\Http\Request;

class TalkController extends BaseController
{
    /**
     * 话题
     */

//    public function index()
//    {
//        return view('home.talk.index');
//    }

    /**
     * 专栏选择
     */
    public function getTopic()
    {
        $apiTopic = ApiTopic::getTopicsByLimit(1000);
        if ($apiTopic['code']!=0) {
            echo "<script>alert('".$apiTopic['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'topics' => $apiTopic['data'],
        ];
        return view('home.talk.topic', $result);
    }

    public function create($topic)
    {
        if (!Session::has('user')) { return redirect(DOMAIN.'login'); }
        //限制每个用户每天发布的数量
        $apiTalk = ApiTalk::index($this->limit,1,0,0);
        if ($apiTalk['code']==0 && count($apiTalk['data'])>=5) {
            echo "<script>alert('今天的发布已达上限！');history.go(-1);</script>";exit;
        }
        $result = [
            'cates' => $this->getCates($topic),
            'topic' => $topic,
        ];
        return view('home.talk.create', $result);
    }

    public function store(Request $request)
    {
        if (!Session::has('user')) { return redirect(DOMAIN.'login'); }
        $data = [
            'name'  =>  $request->name,
            'topic_id' =>  $request->topic,
            'cate'  =>  $request->cate,
            'intro' =>  $request->intro,
            'uid'   =>  Session::get('user.uid'),
            'uname' =>  Session::get('user.username'),
        ];
        $apiTalk = ApiTalk::add($data);
        if ($apiTalk['code']!=0) {
            echo "<script>alert('".$apiTalk['msg']."');history.go(-1);</script>";exit;
        }
        //去奖励
        //??
        return redirect(DOMAIN);
    }






    public function getCates($topic)
    {
        $apiCate = ApiCate::getCatesByLimit(1000,$topic);
        return $apiCate['code']==0 ? $apiCate['data'] : [];
    }
}