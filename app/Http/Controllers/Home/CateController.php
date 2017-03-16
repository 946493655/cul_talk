<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiTalk\ApiCate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as AjaxRequest;
use Illuminate\Support\Facades\Input;

class CateController extends BaseController
{
    /**
     * 类别
     */

    public function store(Request $request,$topic)
    {
        if (!$request->name) {
            echo "<script>alert('名称必填！');history.go(-1);</script>";exit;
        }
        if ($topic==2 && !in_array($request->pid,[1,2,3])) {
            echo "<script>alert('类别选项错误！');history.go(-1);</script>";exit;
        } else if ($topic==4 && !in_array($request->pid,[7,8,9])) {
            echo "<script>alert('类别选项错误！');history.go(-1);</script>";exit;
        }
        $data = [
            'name'  =>  $request->name,
            'topic_id' =>  $topic,
            'intro' =>  $request->intro,
            'uid'   =>  \Session::get('user.uid'),
        ];
        if (in_array($topic,[2,4])) { $data['pid'] = $request->pid; }
        $apiCate = ApiCate::add($data);
        if ($apiCate['code']!=0) {
            echo "<script>alert('".$apiCate['msg']."');history.go(-1);</script>";exit;
        }
        //页面跳转
        if ($topic==1) {
            $view = 'free';
        } else if ($topic==2) {
            $view = 'graph';
        } else if ($topic==3) {
            $view = 'video';
        } else if ($topic==4) {
            $view = 'design';
        } else if ($topic==5) {
            $view = 'track';
        }
        return redirect(DOMAIN.'s/'.$view);
    }

//    /**
//     * 通过 topic、上级cate 获取子类别
//     */
//    public function getCatesByTopic()
//    {
//        if (AjaxRequest::ajax()) {
//            $topic = Input::get('topic');
//            $apiCate = ApiCate::getCatesByTopic($topic);
//            if ($apiCate['code']!=0) {
//                echo json_encode(array('code'=>-2, 'msg'=>'参数错误！'));exit;
//            }
//            //拼接html
//            $html = "";
//            if ($topic==1) {
//                $html .= "<p>3D软件</p>";
//            } else if ($topic==2) {
//                $html .= "<p>合成软件</p>";
//            } else if ($topic==3) {
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