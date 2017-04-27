<?php

/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/3/24-3:38
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Home\Model;

use Think\Model;

class BaseModel extends Model
{
    Protected $autoCheckFields = false;

    /**
     * @return mixed 返回导航菜单
     */
    public function getNav()
    {
        $cate = M('Category');
        $where = array('pid' => 0);
        $nav = $cate->where($where)->field('id, name, sort')->limit(5)->order('sort DESC')->select();
        return $nav;
    }

    /**
     * @return mixed 返回友情链接
     */
    public function getLink()
    {
        $linkModel = M('link');
        $link = $linkModel->field('id, name, url')->limit(10)->order('id DESC')->select();
        return $link;
    }

    /**
     * @return mixed 返回系统设置的信息
     */
    public function getSystem()
    {
        $systemModel = M('system');
        $system = $systemModel->where(array('id' => 1))->find();
        return $system;
    }

}