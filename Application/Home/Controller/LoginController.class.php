<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/4/14-12:25
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Home\Controller;


use Common\Controller\CommonController;
use Home\Model\UserModel;
use Think\Controller;
use Think\Verify;

class LoginController extends CommonController
{
    //用户登录
    public function login()
    {
        if (!IS_AJAX) {
            $this->redirect('Index/index');
        }
        $data['code'] = I('post.code', '', 'htmlspecialchars');
        $data['username'] = I('post.username', '', 'htmlspecialchars');
        $data['password'] = I('post.password', '', 'htmlspecialchars');

        $rules = array(
            array('username', 'require', '用户名/邮箱不能为空'),
            array('password', 'require', '密码不能为空'),
            array('password', '6,24', '密码长度必须在6-24之间', 0, 'length'),
            array('code', 'require', '验证码不能为空'),
            array('code', '4', '验证码长度必须是4位！', 0, 'length'),

        );
        $userModel = new UserModel();
        $info = $userModel->validate($rules)->create($data);

        $res = array(
            'state' => 2
        );
        if (!$info) {
            $res['msg'] = $userModel->getError();
            $this->ajaxReturn($res);
            exit();
        }
        $verify = new Verify();
        if (!$verify->check($data['code'])) {
            $res['msg'] = '验证码错误';
            $this->ajaxReturn($res);
            exit();
        }

        $where['username'] = $data['username'];
        $where['email'] = $data['username'];
        $where['_logic'] = 'OR';
        $user = $userModel->where($where)->field('id,username,password')->find();
        if (!$user) {
            $res['msg'] = '用户名或密码不正确';
            $this->ajaxReturn($res);
            exit();
        } else {
            if ($user['password'] == md5($data['password'])) {
                $dataInfo['logintime'] = time();
                $dataInfo['loginip'] = getIp();
                $loginIp = md5AuthCode($dataInfo['loginip'], 5, 8);
                $unique = md5AuthCode(session_id() . time(), 8, 12);
                $dataInfo['session_id'] = md5($loginIp . $unique);
                $condition['username'] = $user['username'];
                $userModel->where($condition)->save($dataInfo);
                session('username', $user['username']);
                session('session_unique', $dataInfo['session_id']);
                $res['state'] = 1;
                $res['msg'] = '登录成功';
                $this->ajaxReturn($res);

            } else {
                $res['msg'] = '用户名/邮箱或密码不正确';
                $this->ajaxReturn($res);
                exit();
            }
        }

    }

    /**
     * 用户注册
     */
    public function register()
    {
        if (!IS_AJAX) {
            $this->redirect('Index/index');
        }
        $data['code'] = I('post.code', '', 'htmlspecialchars');
        $data['username'] = I('post.username', '', 'htmlspecialchars');
        $data['password'] = I('post.psw', '', 'htmlspecialchars');
        $data['repassword'] = I('post.repsw', '', 'htmlspecialchars');
        $rules = array(

            array('username', 'require', '用户名不能为空'),
            array('username', '2,12', '用户名长度必须在2-12之间', 0, 'length'),
            array('password', 'require', '密码不能为空'),
            array('repassword', 'require', '请再次确认密码'),
            array('password', '6,24', '密码长度必须在6-24之间', 0, 'length'),
            array('repassword', 'password', '确认密码不正确', 0, 'confirm'), // 验证确认密码是否和密码一致
            array('code', 'require', '验证码不能为空'),
            array('code', '4', '验证码长度必须是4位！', 0, 'length'),
            array('username', '', '用户名已经被注册！', 0, 'unique', 1),

        );
        $userModel = new UserModel();
        $info = $userModel->validate($rules)->create($data);
        $res = array(
            'state' => 2
        );
        if (!$info) {
            $res['msg'] = $userModel->getError();
            $this->ajaxReturn($res);
            exit();
        }
        //检测验证码是否输入正确
        $verify = new Verify();
        if (!$verify->check($data['code'])) {
            $res['msg'] = '验证码错误';
            $this->ajaxReturn($res);
            exit();
        }
        $userData['username'] = $data['username'];
        $userData['password'] = md5($data['password']);
        if ($userModel->add($userData)) {
            $res['state'] = 1;
            $res['msg'] = '账号注册成功';
            $this->ajaxReturn($res);
        } else {
            $res['msg'] = '请重新再试';
            $this->ajaxReturn($res);
        }


    }


}