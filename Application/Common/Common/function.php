<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/3/21-19:38
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/


/**
 * @return string 返回IP地址
 */
function getIp(){
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    } else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
        $ip = getenv("REMOTE_ADDR");
    } else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
        $ip = $_SERVER['REMOTE_ADDR'];
    } else {
        $ip = "";
    }
    return ($ip);
}

/**
 * @param $str 需要加密的字符串
 * @param $start 字符串截取开始的位置
 * @param $end  字符串截取结束的位置
 * @return string 返回加密后的字符串
 */
function md5AuthCode($str,$start,$end){
    $str = substr(md5($str), $start, $end);
    return $str;
}

function diffTime($time){
    $now =time();
    $diffTime = $now -intval($time);
    if($diffTime<86400){
         $time =floor($diffTime/3600).'小时前';
    }elseif (86400 <= $diffTime && $diffTime <86400*5){
        $time =floor($diffTime/86400).'天前';
    }else{
        $time =date('Y-m-d',$time);
    }
    return $time;




}
