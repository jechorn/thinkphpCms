<?php

namespace Admin\Model;

use Think\Model;

/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/1/15-13:18
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/
class SystemModel extends Model
{
    // 自动验证定义
    protected $_validate = array(
        array('webname', 'require', '网站名称不能为空'),
        array('webname', '2,10', '网站名称长度必须在2-10之间！', 0, 'length'),
        array('keywords', 'require', '关键词不能为空'),
        array('keywords', '2,100', '关键词长度必须在2-100之间！', 0, 'length'),
        array('icp', 'require', '网站备案号不能为空'),
        array('icp', '5,30', '网站备案号长度必须在5-30之间！', 0, 'length'),
        array('copyright', 'require', '网站copyright不能为空'),
        array('copyright', '5,100', '网站copyright长度必须在5-100之间！', 0, 'length'),
        array('description', 'require', '网站描述不能为空'),
        array('description', '5,30', '网站描述长度必须在5-200之间！', 0, 'length'),
        array('image', 'require', '网站底部图片logo链接不能为空'),
    );

}