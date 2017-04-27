<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/1/18-18:48
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Admin\Controller;

use Admin\Controller;


class AttrController extends BaseController
{

    /**
     * 属性列表页面
     */
    public function index()
    {
        $this->list = M('Attr')->order('id')->select();
        $this->display();
    }

    /**
     * 属性添加页面展示
     */
    public function add()
    {
        $this->display();
    }

    /**
     * 属性添加更新处理
     */
    public function addHandle()
    {
        $cid = I('get.id', '', 'intval');
        $data['name'] = I('post.name', '', 'htmlspecialchars');
        $data['color'] = I('post.color', '', 'htmlspecialchars');
        if (empty($data['name']) || empty($data['name'])) {
            $this->error('所填信息不能为空');
        } else {
            if (mb_strlen($data['name']) > 3 || mb_strlen($data['name']) < 1) {
                $this->error('属性标题必须在3个字符内');
            }
            if (mb_strlen($data['color']) !== 7) {
                $this->error('属性颜色格式不正确');
            }
        }
        $attr = M('Attr');
        if (empty($cid)) {
            if ($attr->add($data)) {
                $this->success('属性添加成功');
            } else {
                $this->error($attr->getError());
            }
        } else {
            if ($attr->where(array('id' => $cid))->save($data)) {
                $this->success('属性修改成功', U('Attr/index'));
            } else {
                $this->error('属性未修改');
            }
        }


    }

    /**
     * 属性更新页面展示
     */
    public function update()
    {
        $cid = I('get.id', '', 'intval');
        if (is_numeric($cid) && $cid > 0) {
            $attr = M('Attr');
            $result = $attr->where(array('id' => $cid))->select();
            if (!empty($result)) {
                $this->assign('attrUpdate', '属性修改');
                $this->assign('result', $result);
                $this->display(add);
            } else {
                $this->redirect('Attr/index');
            }
        } else {
            $this->redirect('Attr/index');
        }
    }

    /**
     * 属性删除处理
     */
    public function delete()
    {
        if (IS_AJAX) {
            $cid = I('post.cid', '', 'intval');
            $attr = M('Attr');
            $result = $attr->where(array('id' => $cid))->delete();
            if ($result) {
                $res = array(
                    'status' => 1,
                    'msg' => '删除成功'
                );
            } else {
                $res = array(
                    'status' => 2,
                    'msg' => '删除失败'
                );
            }
            $this->ajaxReturn($res);
        }
    }
}