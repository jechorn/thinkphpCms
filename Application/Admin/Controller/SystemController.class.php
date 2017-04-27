<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/1/5-5:10
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Admin\Controller;

use Admin\Controller;
use Admin\Model;
use Think\Image;
use Think\Upload;


class SystemController extends BaseController
{
    private $ImagerootPath ='./Uploads/';
    public function add()
    {

        $this->display();
    }

    /**
     * 添加系统信息
     */
    public function addInfo()
    {
        if (IS_AJAX) {
            $imageCropper = json_decode($_POST['cropData'],true);
            $res = $this->picUpload();
            if($res['state']==2){
                $this->ajaxReturn($res);
                return false;
            }
            $image =new Image();
            $url = $this->ImagerootPath.$res['image'];

            $image->open($url);
            $image->crop($imageCropper['width'],$imageCropper['height'],$imageCropper['x'],$imageCropper['y']);
            $image->save($url,'png');


            $data['image'] = $res['image'];

            $data['id'] = 1;
            $data['webname'] = I('post.webname', '', 'htmlspecialchars');
            $data['keywords'] = I('post.keywords', '', 'htmlspecialchars');
            $data['icp'] = I('post.icp', '', 'htmlspecialchars');
            $data['copyright'] = I('post.copyright', '', 'htmlspecialchars');
            $data['description'] = I('post.description', '', 'htmlspecialchars');
            $system = D('System');
            if ($res = $system->create($data)) {
                if ($system->save()) {
                    $res = array(
                        'state' => 1,
                        'msg' => '信息更新成功！'
                    );

                } else {
                    $res = array(
                        'state' => 2,
                        'msg' => '信息更新失败！'
                    );
                    unlink($url);
                }

            } else {
                $res = array(
                    'state' => 2,
                    'msg' => $system->getError()
                );

            }
            $this->ajaxReturn($res);

        } else {
            $this->redirect('System/add');
        }

    }

    /**
     * 图片上传
     */
    private function picUpload()
    {
        $upload = new Upload();
        $upload->maxSize = 2444152;// 设置附件上传大小
        $upload->exts = array('jpg', 'png', 'gif', 'jpeg');// 设置附件上传类型
        $upload->rootPath = $this->ImagerootPath; // 设置附件上传根目录
        $upload->savePath = ''; // 设置附件上传（子）目录
        $info = $upload->upload();
        //print_r($info);
        if($info){
            $response = array(
                'state' => 1,
                'msg' => $upload->getError(),
                'image' => trim($info[file][savepath] . $info[file][savename])
            );
        }else{
            $response = array(
                'state' => 2,
                'msg' => $upload->getError()
            );
        }

        return $response;
    }


}