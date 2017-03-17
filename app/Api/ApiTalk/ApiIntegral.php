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
}