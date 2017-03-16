<?php

/**
 * 用户函数，获取用户相关信息，函数名：User + 结果 + By + 添加
 */

use App\Api\ApiTalk\ApiCate;


//通过topic，获取类别
function CateByTopicid($limit,$topic_id)
{
    $apiCate = ApiCate::getParent($limit,$topic_id);
    return $apiCate['code']==0 ? $apiCate['data'] : [];
}

//通过pid，获取上级类别
function CatesByPid($pid=0)
{
    $apiCate = ApiCate::show($pid);
    return $apiCate['code']==0 ? $apiCate['data'] : [];
}

//通过level，获取类别
function CatesByLevel($topic,$level=2)
{
    $apiCate = ApiCate::getCatesByTopic($topic,$level);
    return $apiCate['code']==0 ? $apiCate['data'] : [];
}