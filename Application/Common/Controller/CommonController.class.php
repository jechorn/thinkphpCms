<?php

/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/4/15-9:30
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/
namespace Common\Controller;
use Think\Controller;
use Think\Verify;

class CommonController extends Controller
{

    /**
     * 生成验证码
     */
    public function createVerify()
    {
        //验证码配置项
        $config = array(
            'fontSize' => C('FONT_SIZE'),    // 验证码字体大小
            'length' => C('LENGTH'),     // 验证码位数
            'useNoise' => C('USE_NOISE'), // 关闭验证码杂点
        );
        $verify = new Verify($config);
        $verify->entry();

    }


}