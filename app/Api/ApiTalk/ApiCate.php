<?php
namespace App\Api\ApiTalk;

use Curl\Curl;

class ApiCate
{
    /**
     * 类别接口
     */

    public static function getCatesByLimit($limit,$topic_id)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/cate/catesbylimit';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit' =>  $limit,
            'topic_id'  =>  $topic_id,
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