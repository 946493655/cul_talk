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

    public function store(){}

    /**
     * 通过 topic、上级cate 获取子类别
     */
    public function getCatesByTopic()
    {
        if (AjaxRequest::ajax()) {
            $cate = Input::get('cate');
            $apiCate = ApiCate::getCatesByTopic($cate);
            if ($apiCate['code']!=0) {
                echo json_encode(array('code'=>-2, 'msg'=>'参数错误！'));exit;
            }
            //拼接html
            $html = "";
            if ($cate==1) {
                $html .= "<p>3D软件</p>";
            } else if ($cate==2) {
                $html .= "<p>合成软件</p>";
            } else if ($cate==3) {
                $html .= "<p>剪辑软件</p>";
            }
            $html .= "<ul>";
            foreach ($apiCate['data'] as $vcate) {
                $html .= "<li><a href=''>".$vcate['name']."</a></li>";
            }
            $html .= "</ul>";
            echo json_encode(array('code'=>0, 'data'=> $html));exit;
        }
        echo json_encode(array('code'=>-1, 'msg'=>'参数错误！'));exit;
    }
}