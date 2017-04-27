<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/4/16-9:14
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Home\Controller;

use Classes\dataVerify;
use Home\Controller\IsLoginController;
use Home\Model\CommentsViewModel;
use Think\Model;


class CommentController extends IsLoginController
{

    //评论添加
    public function addComment()
    {
        //state 1为用户已经登录并且数据验证成功，2为用户没有登录，3用户已经登录，但数据没有验证成功
        if (!IS_AJAX) {
            $this->redirect('Index/index');
        }
        $info = $this->isLogin();
        if (!array_key_exists('state', $info)) {

            $data['comment'] = I('post.comment', '', 'strip_tags');
            $data['aid'] = I('post.aid', '', 'intval');

            $dataVerify = new dataVerify();
            if (false === $dataVerify::isEmpty($data['comment'])) {
                $this->msg = [
                    'state' => 3,
                    'msg' => '评论不能为空'
                ];
                $this->ajaxReturn($this->msg);
                exit();
            }
            if (false === $dataVerify::length($data['comment'], '', 10, 250)) {
                $this->msg = [
                    'state' => 3,
                    'msg' => '字数在10-250之间'
                ];
                $this->ajaxReturn($this->msg);
                exit();
            }
            if (false === $dataVerify::isEmpty($data['aid'])) {
                $this->msg = [
                    'state' => 3,
                    'msg' => '无法找到该文章'
                ];
                $this->ajaxReturn($this->msg);
                exit();
            }
            $data['uid'] = $info['id'];
            $data['time'] = time();
            $commentModel = M('Comments');
            if ($commentModel->add($data)) {
                $this->msg = [
                    'state' => 1,
                    'msg' => '评论添加成功'
                ];
                $this->ajaxReturn($this->msg);
                exit();
            } else {
                $this->msg = [
                    'state' => 3,
                    'msg' => '数据添加失败'
                ];
                $this->ajaxReturn($this->msg);
                exit();
            }

        } else {
            $this->msg = $info;
            $this->ajaxReturn($this->msg);
        }

    }

    public function handle()
    {
        if(!IS_AJAX){
            $this->redirect('Index/index');
        }
        $data = I('post.','','intval');
        if(empty($data['type'])||empty($data['aid'])){
            $this->msg = [
                'state'=> 2,
                'msg'=>'操作失误'
            ];
            $this->ajaxReturn($this->msg);
            exit();
        }
        $commentsModel = new CommentsViewModel();
        $result = $commentsModel->getComments($data['aid'],$data['type']);
        if(!empty($result)){
            foreach ($result as $k=>$v){
                $result[$k]['time'] = diffTime($v['time']);
            }

        }
        $this->msg = [
            'state' => 1,
            'msg' =>$result
        ];

        $this->ajaxReturn($this->msg);

    }

    public function ifLike()
    {
        if(!IS_AJAX){
            $this->redirect('Index/index');
        }
        $data = I('post.','','intval');
        if(empty($data['type'])||empty($data['aid'])||empty($data['id'])){
            $this->msg = [
                'state'=> 2,
                'msg'=>'操作失败'
            ];
            $this->ajaxReturn($this->msg);
            exit();
        }
        switch ($data['type']){
            case 1:
                $title = '点赞';
                $field = 'up';

                break;
            case 2:
                $title = '嘘';
                $field = 'down';
        }
        $commentId = 'comment'.md5($data['id']).md5($data['aid']);

        if(array_key_exists($commentId,$_SESSION)){

            if(true === session("$commentId.type") && $data['aid'] === session("$commentId.aid") && $data['id'] === session("$commentId.id")){
                $this->msg = [
                    'state'=> 2,
                    'msg'=>'亲，不要贪心哦'
                ];
                $this->ajaxReturn($this->msg);
                exit();
            }
        }
        $commentModel = new CommentsViewModel();
        $result = $commentModel->setLike($data);

        if($result){
            $commentSession = array(
                'type' =>true,
                'aid' => $data['aid'],
                'id' => $data['id']
            );
            $commentId = 'comment'.md5($data['id']).md5($data['aid']);
            session($commentId,$commentSession);
            $isLike = $commentModel->where(array('aid'=>$data['aid'],'id'=>$data['id']))->field($field)->find();
            $this->msg = [
                'state'=> 1,
                'msg'=>$title.'成功',
                'data' => $isLike[$field]
            ];
        }else{
            $this->msg = [
                'state'=> 2,
                'msg'=>'操作失败'
            ];
        }
        $this->ajaxReturn($this->msg);

    }


}