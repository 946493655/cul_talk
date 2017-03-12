<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiTalk\ApiCate;
use App\Api\ApiTalk\ApiTalk;
use Illuminate\Support\Facades\Request as AjaxRequest;
use Illuminate\Support\Facades\Input;

class HomeController extends BaseController
{
    /**
     * 前台首页
     */

    public function index()
    {
        $result = [
            //获取自由话题类别
            'cate1s' => $this->getCates(3,1),
            'talk1s' => $this->getTalks(8,1),
            //获取图形软件类别
            'cate2s' => $this->getCates(3,2),
            'talk2s' => $this->getTalks(8,2),
            //获取视频作品类别
            'cate3s' => $this->getCates(3,3),
            'talk3s' => $this->getTalks(8,3),
            //获取网站设计类别
            'cate4s' => $this->getCates(3,4),
            'talk4s' => $this->getTalks(8,4),
            //获取人生足迹类别
            'cate5s' => $this->getCates(3,5),
            'talk5s' => $this->getTalks(8,5),
        ];
        return view('home.home.index', $result);
    }

    /**
     * 自由话题列表
     */
    public function getFree()
    {
        $topic = 1;
        $result = [
            'cates' => $this->getCates(3,$topic),
            'topic' =>  $topic,
        ];
        return view('home.home.show', $result);
    }

    /**
     * 图形软件列表
     */
    public function getGraph($cate=0)
    {
        $topic = 2;
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'graph';
        $apiTalk  = ApiTalk::index($this->limit,$pageCurr,$cate);
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
            'topic' =>  $topic,
        ];
        return view('home.home.show', $result);
    }

    /**
     * 视频作品列表
     */
    public function getVideo()
    {
        $topic = 3;
        $result = [
            'cates' => $this->getCates(3,$topic),
            'topic' =>  $topic,
        ];
        return view('home.home.show', $result);
    }

    /**
     * 网站设计列表
     */
    public function getDesign()
    {
        $topic = 4;
        $result = [
            'cates' => $this->getCates(3,$topic),
            'topic' =>  $topic,
        ];
        return view('home.home.show', $result);
    }

    /**
     * 人生足迹列表
     */
    public function getTrack()
    {
        $topic = 5;
        $result = [
            'cates' => $this->getCates(3,$topic),
            'topic' =>  $topic,
        ];
        return view('home.home.show', $result);
    }

//    public function show($topic_id)
//    {
//        $apiCate = ApiCate::getCatesByTopic($topic_id);
//        return view('home.home.show');
//    }

    /**
     * 通过 topic 获取类别
     */
    public function getCates($limit,$topic)
    {
        $apiCate = ApiCate::getCatesByLimit($limit,$topic);
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

    /**
//     * 通过 cate 获取后台列表
//     */
//    public function getTalks(){}

//    /**
//     * 通过 上级category 获取子类别
//     */
//    public function getSubCatesByPid()
//    {
//        if (AjaxRequest::ajax()) {
//            $cate = Input::get('cate');
//            $apiCate = ApiCate::getCatesByPid($cate);
//            if ($apiCate['code']!=0) {
//                echo json_encode(array('code'=>-2, 'msg'=>'参数错误！'));exit;
//            }
//            //拼接html
//            $html = "";
//            if ($cate==1) {
//                $html .= "<p>3D软件</p>";
//            } else if ($cate==2) {
//                $html .= "<p>合成软件</p>";
//            } else if ($cate==3) {
//                $html .= "<p>剪辑软件</p>";
//            }
//            $html .= "<ul>";
//            foreach ($apiCate['data'] as $vcate) {
//                $html .= "<li><a href=''>".$vcate['name']."</a></li>";
//            }
//            $html .= "</ul>";
//            echo json_encode(array('code'=>0, 'data'=> $html));exit;
//        }
//        echo json_encode(array('code'=>-1, 'msg'=>'参数错误！'));exit;
//    }
}