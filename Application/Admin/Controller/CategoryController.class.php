<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:分类添加
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/1/5-6:20
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Admin\Controller;

use Admin\Controller;
use Classes\UnlimitCate;
use Think\Model;

class CategoryController extends BaseController
{
    /**
     * 分类列表页
     */
    public function index()
    {
        $cate = M('category')->select();
        $mergeCate = new UnlimitCate();
        $cate = $mergeCate->unlimitOneCate($cate);
        $this->assign('cate', $cate);
        $this->display();
    }

    /**
     * 分类添加
     */
    public function add()
    {
        $cateId = I('get.id', '', 'intval');
        if (!empty($cateId)) {
            $where = array('id' => $cateId);
            $field = array('id', 'name');
            $cateInfo = M('category')->where($where)->field($field)->find();
            $cateInfo['title'] = '分类添加';
            $this->assign('cateInfo', $cateInfo);
        }
        $this->display();
    }

    /**
     * 分类添加ajax处理
     */
    public function addCate()
    {
        if (IS_AJAX) {
            $data['pid'] = I('post.pid', 0, 'intval');
            $data['name'] = I('post.name', '', 'htmlspecialchars');
            $data['sort'] = I('post.sort', '', 'intval');

            if (!empty($data['name']) && !empty($data['sort'])) {

                $category = new Model('category');
                if ($category->add($data)) {
                    $res = array(
                        'status' => 200,
                        'msg' => '添加记录成功',
                        'url' => ''

                    );

                } else {
                    $res = array(
                        'msg' => '添加记录失败',
                        'url' => ''
                    );

                }
            } else {
                $res = array(
                    'msg' => '信息不能为空',
                    'url' => ''
                );

            }
            $this->ajaxReturn($res);
        } else {
            $this->redirect('Category/index');
        }
    }


    /**
     * 分类修改展示页面
     */
    public function update()
    {
        $cateId = I('get.id', '', 'intval');
        if (!empty($cateId)) {
            $where = array('id' => $cateId);
            $field = array('id', 'name', 'sort');
            $cateInfo = M('category')->where($where)->field($field)->find();
            $cateInfo['title'] = '分类修改';
            $this->assign('cateInfo', $cateInfo);
            $this->display(add);

        } else {
            $this->redirect('Category/index');
        }

    }

    /**
     * 分类修改ajax处理
     */
    public function updateCate()
    {
        if (IS_AJAX) {
            $data['name'] = I('post.name', '', 'htmlspecialchars');
            $data['sort'] = I('post.sort', 'intval');
            $data['id'] = I('post.pid', 'intval');
            if (!empty($data['name']) && !empty($data['sort']) && !empty($data['id'])) {

                $category = new Model('category');
                if ($category->save($data)) {
                    $res = array(
                        'status' => 1,
                        'msg' => '分类修改成功',
                        'url' => U('Category/index')
                    );

                } else {
                    $res = array(
                        'status' => 2,
                        'msg' => '添加记录失败',
                    );

                }
            } else {
                $res = array(
                    'status' => 2,
                    'msg' => '信息不能为空',
                );

            }

            $this->ajaxReturn($res);
        } else {
            $this->redirect('Category/index');
        }
    }

    /**
     * 分类删除
     */
    public function delete()
    {

        $cateId = I('post.id', '', 'intval');
        if ($cateId > 0) {
            $category = M('category');
            $cate = $category->field(array('id', 'pid'))->select();
            $childrenCate = new UnlimitCate();
            $cates = $childrenCate->getChildrens($cate, $cateId);
            $arr = array();
            $arr[] = $cateId;
            foreach ($cates as $v) {
                $arr[] = intval($v['id']);
            }
            $where = implode(',', $arr);
            $result = $category->where(array('id' => array('in', $where)))->delete();
            if ($result) {
                $response = array(
                    'status' => 1,
                    'msg' => '删除分类成功',
                    'cid' => $arr
                );
            } else {
                $response = array(
                    'status' => 2,
                    'msg' => '删除分类失败'
                );
            }

        } else {
            $response = array(
                'status' => 2,
                'msg' => '未知分类'
            );

        }
        $this->ajaxReturn($response);

    }

}