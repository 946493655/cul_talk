<?php
namespace App\Api\ApiTalk;

use Curl\Curl;

class ApiTalkClick
{
    /**
     * 点赞接口
     */

    public static function index($limit,$pageCurr=1,$talkid=0,$uid=0)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/talkclick';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit' =>  $limit,
            'page'  =>  $pageCurr,
            'talkid'    =>  $talkid,
            'uid'   =>  $uid
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'data' => ApiBase::objToArr($response->data),
            'pagelist' => ApiBase::objToArr($response->pagelist),
        );
    }

    public static function add($id,$uid)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/talkclick/add';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'id'    =>  $id,
            'uid'   =>  $uid,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'msg' => $response->error->msg,
        );
    }
}