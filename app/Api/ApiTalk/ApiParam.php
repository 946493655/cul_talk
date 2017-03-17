<?php
namespace App\Api\ApiTalk;

use Curl\Curl;

class ApiParam
{
    /**
     * 论坛参数
     * 一用户一记录
     */

    public static function show($uid)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/param/show';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'uid'       =>  $uid,
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
}