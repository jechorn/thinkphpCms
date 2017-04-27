<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/1/16-18:03
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Admin\Model;

use Think\Model;

class CarouselModel extends Model
{
    // 自动验证定义
    protected $_validate = array(
        array('name', 'require', '轮播图名称不能为空'),
        array('name', '2,10', '轮播图名称长度必须在2-10之间！', 0, 'length'),
        array('description', 'require', '轮播图描述不能为空'),
        array('description', '2,100', '轮播图描述长度必须在4-100之间！', 0, 'length'),
        array('link', 'require', '轮播图链接地址不能为空'),
        array('link', "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", '轮播图链接地址不合法', 1, 'regex'),

    );


}