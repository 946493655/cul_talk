<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiTalk\ApiCate;
use App\Api\ApiTalk\ApiTalk;
use App\Api\ApiTalk\ApiTopic;

class HomeController extends BaseController
{
    /**
     * 前台页面
     */

    protected $crumbTitles = [
        1=>'类别自定','视觉设计','视频制作','网站研发','足迹沧桑',
    ];

    /**
     * 首页
     */
    public function index()
    {
        $apiTopic = ApiTopic::index(10,1,0);
        if ($apiTopic['code']!=0) {
            echo "<script>alert('".$apiTopic['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'topics' => $apiTopic['data'],
            'crumbTitles' => $this->crumbTitles,
        ];
        return view('home.home.index', $result);
    }

    /**
     * 各个列表
     */
    public function show($topicUrl='graph',$cate=0)
    {
        if ($topicUrl=='free') {
            $topic = 1;     //自由话题列表
        } else if ($topicUrl=='graph') {
            $topic = 2;     //图形软件列表
        } else if ($topicUrl=='video') {
            $topic = 3;     //视频作品列表
        } else if ($topicUrl=='design') {
            $topic = 4;     //网站设计列表
        } else if ($topicUrl=='track') {
            $topic = 5;     //人生足迹列表
        } else {
            $topic = 0;     //更多
        }
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'t/'.$topic;
        $apiTalk  = ApiTalk::index($this->limit,$pageCurr,$topic,$cate);
        if ($apiTalk['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiTalk['data']; $total = $apiTalk['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,DOMAIN,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'prefix_url' => $prefix_url,
            'pagelist' => $pagelist,
            'cates' => $this->getCates(3,$topic),
            'crumbs' => $this->getCateParent($cate),
            'crumbTitles' => $this->crumbTitles,
            'topic' =>  $topic,
            'cate_curr' => $cate,
        ];
        return view('home.home.show', $result);
    }

    /**
     * 通过 topic 获取类别
     */
    public function getCates($limit,$topic)
    {
        $apiCate = ApiCate::getParent($limit,$topic);
        return $apiCate['code']==0 ? $apiCate['data'] : [];
    }

    /**
     * 获取父级类别
     */
    public function getCateParent($cate)
    {
        $apiCate = ApiCate::show($cate);
        return $apiCate['code']==0 ? $apiCate['data'] : [];
    }

    /**
     * 通过 topic 获取话题
     */
    public function getTalks($limit,$topic)
    {
        $apiTalk = ApiTalk::index($limit,1,$topic,0);
        return $apiTalk['code']==0 ? $apiTalk['data'] : [];
    }
}