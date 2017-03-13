<?php

/**
 * 用户函数，获取用户相关信息，函数名：User + 结果 + By + 添加
 */

use App\Api\ApiTalk\ApiTalk;


//通过topic，获取话题
function TalkByTopicid($limit,$topic_id)
{
    $apiTalk = ApiTalk::index($limit,1,$topic_id,0);
    return $apiTalk['code']==0 ? $apiTalk['data'] : [];
}