<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/4/12-16:34
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Home\Controller;


use Think\Controller;

class EmptyController extends Controller
{
    public function index(){
        header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码
        $this->display("Public:404");
    }
}