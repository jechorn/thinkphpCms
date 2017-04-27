<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/1/5-5:40
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Admin\Controller;

use Admin\Controller;
use Think\Image;
use Think\Upload;


class CarouselController extends BaseController
{

    /**
     * 轮播图列表展示
     */
    public function index()
    {
        $carousel = D('Carousel');
        $list = $carousel->order('status DESC')->select();
        $this->assign('list', $list);
        $this->display();
    }

    /**
     * 轮播图状态更新
     */
    public function updateStatus()
    {
        $cid = I('post.cid', '', 'intval');
        $status = I('post.status', '', 'intval');
        $status = $status == 1 ? 0 : 1;
        $Msg = $status == 1 ? '关闭' : '开启';
        $carousel = D('Carousel');
        $info = $carousel->where(array('id' => $cid))->setField('status', $status);
        if ($info) {
            $res = array(
                'status' => 1,
                'msg' => $Msg . '成功'
            );
        } else {
            $res = array(
                'status' => 2,
                'msg' => $Msg . '失败'
            );
        }
        $this->ajaxReturn($res);

    }

    /**
     * 轮播图删除
     */
    public function deleteCarousel()
    {
        $cid = I('post.cid', '', 'intval');
        $carousel = D('Carousel');
        $result = $carousel->where(array('id' => $cid))->field('url')->select();
        if (!empty($result)) {
            $Msg = '删除';
            $info = $carousel->where(array('id' => $cid))->delete();
            if ($info) {
                unlink('./Uploads/' . $result[0]['url']);
                $res = array(
                    'status' => 1,
                    'msg' => $Msg . '成功'
                );
            } else {
                $res = array(
                    'status' => 2,
                    'msg' => $Msg . '失败'
                );
            }

        }

        $this->ajaxReturn($res);

    }

    /**
     * 轮播图添加
     */
    public function add()
    {
        $this->display();

    }

    public function addCarousel()
    {
        if (IS_AJAX) {
            $data['name'] = I('post.carousel_name', '', 'htmlspecialchars');
            $data['description'] = I('post.carousel_description', '', 'htmlspecialchars');
            $data['link'] = I('post.carousel_link', '', 'htmlspecialchars');
            $data['status'] = I('post.carousel_status', '', 'intval');
            $cropData = I('post.cropData', '', '');
            $cropData = json_decode($cropData, true);
            $upload = new Upload();
            $upload->maxSize = 2444152;// 设置附件上传大小
            $upload->exts = array('jpg', 'png', 'gif', 'jpeg');// 设置附件上传类型
            $upload->rootPath = './Uploads/'; // 设置附件上传根目录
            $upload->savePath = ''; // 设置附件上传（子）目录
            $info = $upload->upload();
            if (!$info) {
                $res = array(
                    'status' => 2,
                    'msg' => $upload->getError()
                );
            } else {
                $data['url'] = $info[file][savepath] . $info[file][savename];
                $imageUrl = $upload->rootPath . $data['url'];
                $image = new Image();
                $image->open($imageUrl);
                $image->crop($cropData['width'], $cropData['height'], $cropData['x'], $cropData['y']);
                $image->save($imageUrl);
                $carousel = D('Carousel');
                if ($carousel->create($data)) {
                    if ($carousel->add()) {
                        $res = array(
                            'status' => 1,
                            'msg' => '信息添加成功！'
                        );
                    } else {
                        $res = array(
                            'status' => 2,
                            'msg' => '信息添加失败，请重新添加！'
                        );

                    }
                } else {
                    $res = array(
                        'status' => 2,
                        'msg' => $carousel->getError()
                    );
                }
                if ($res['status'] !== 1) {
                    unlink($imageUrl);
                }
            }
            $this->ajaxReturn($res);
        } else {
            $this->redirect('Carousel/add');
        }


    }


}