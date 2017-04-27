<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/3/20-10:51
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Admin\Controller;


use Classes\dataVerify;
use Common\Controller\CommonController;
use Think\Controller;
use Think\Verify;


class LoginController extends CommonController
{
    private $_msg;  //返回的信息


    /**
     * 登录页面渲染
     */
    public function index()
    {
        if (session('?adminname') && session('?session_id')) {
            $this->success('你已经登录成功正在跳转至首页', U('Index/index'));
            exit;
        }
        $this->display();

    }

    /**
     * @return bool 返回验证错误代码 FALSE为验证失败;TRUE为验证成功.
     */
    public function login()
    {
        if (!IS_AJAX) {
            $this->redirect('Login/index');
        }

        $verify = new Verify();
        $verifyNum = I('post.verify', '', 'htmlspecialchars');
        if (empty($verifyNum)) {
            $this->_msg = [
                'state' => 2,
                'location' => 3,
                'msg' => '请输入验证码'
            ];

            $this->ajaxReturn($this->_msg);
            return false;
        }
        if (!$verify->check($verifyNum)) {
            $this->_msg = [
                'state' => 2,
                'location' => 3,
                'msg' => '验证码错误或者失效'
            ];

            $this->ajaxReturn($this->_msg);
            return false;
        }

        $data = [];
        $data['username'] = I('post.user', '', 'htmlspecialchars');
        $data['password'] = I('post.password', '', 'htmlspecialchars');
        $dataVerify = new dataVerify();

        if (!$dataVerify::isEmpty($data['username'])) {
            $this->_msg = [
                'state' => 2,
                'location' => 1,
                'msg' => '账号或邮箱不能为空'
            ];
            $this->ajaxReturn($this->_msg);
            return false;
        }
        if (!$dataVerify::isEmpty($data['password'])) {
            $this->_msg = [
                'state' => 2,
                'location' => 2,
                'msg' => '密码不能为空'
            ];
            $this->ajaxReturn($this->_msg);
            return false;
        }
        if (!$dataVerify::length($data['username'], '', 5, 20)) {
            $this->_msg = [
                'state' => 2,
                'location' => 2,
                'msg' => '账号或邮箱长度必须在5-20个字符之间'
            ];
            $this->ajaxReturn($this->_msg);
            return false;
        }
        if (!$dataVerify::isPWD($data['password'])) {
            $this->_msg = [
                'state' => 2,
                'location' => 2,
                'msg' => '密码格式不正确，长度必须在6-16字符之间'
            ];
            $this->ajaxReturn($this->_msg);
            return false;
        }
        $admin = M('Admin');
        $condition['adminname'] = $data['username'];
        $condition['email'] = $data['username'];
        $condition['_logic'] = 'OR';
        $info = $admin->where($condition)->field(array('id', 'adminname', 'email', 'password'))->find();
        if (!$info) {
            $this->_msg = [
                'state' => 2,
                'location' => 1,
                'msg' => '不存在此用户'
            ];
            $this->ajaxReturn($this->_msg);
            return false;
        } else {
            if (!($info['password'] == md5($data['password']))) {
                $this->_msg = [
                    'state' => 2,
                    'location' => 2,
                    'msg' => '密码不正确'
                ];
                $this->ajaxReturn($this->_msg);
                return false;
            } else {
                $dataInfo['logintime'] = time();
                $dataInfo['loginip'] = getIp();
                $loginIp = md5AuthCode($dataInfo['loginip'], 5, 8);
                $unique = md5AuthCode(session_id() . time(), 8, 12);
                $dataInfo['session_id'] = md5($loginIp . $unique);
                $admin->where($condition)->save($dataInfo);
                session('adminname', $info['adminname']);
                session('session_id', $dataInfo['session_id']);
                $this->_msg = [
                    'state' => 1,
                    'msg' => $info
                ];
                $this->ajaxReturn($this->_msg);
                return true;

            }

        }

    }

    /**
     * 退出登录
     */
    public function logout()
    {
        session('adminname',null);
        session('session_id', null);
        $this->success('你已经退出登录',U('Login/login'));
    }


}