<?php
namespace App\Api\ApiTalk;

use Curl\Curl;

class ApiIntegral
{
    /**
     * 积分交易
     */

    public static function index($limit,$pageCurr=1,$talkid=0,$uid=0,$genre=1)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/integral';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit' =>  $limit,
            'page'  =>  $pageCurr,
            'talkid'    =>  $talkid,
            'uid'       =>  $uid,
            //genre==1发起方，2接受方
            'genre'     =>  $genre,
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

    /**
     * 一话题一记录
     * 通过 talkid 获取积分交易记录
     */
    public static function getOneByTalkid($talkid)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/integral/onebytalkid';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'talkid'    =>  $talkid,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'data' => ApiBase::objToArr($response->data),
        );
    }

    public static function add($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/integral/add';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, $data);
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'msg' => $response->error->msg,
        );
    }

    /**
     * 设置中意回复人
     */
    public static function setUser($talkid,$uid)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/integral/setuser';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'talkid'    =>  $talkid,
            'uid'       =>  $uid,
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