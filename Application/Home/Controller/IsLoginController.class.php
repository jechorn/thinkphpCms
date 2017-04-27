<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/4/16-16:45
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Home\Controller;


use Think\Controller;
use Think\Model;

class IsLoginController extends Controller
{
    protected $msg; //返回信息
    /**
     * 判断前台用户是否登录
     */
    protected function isLogin()
    {

        $username = $this->saveUsernameSession($_SESSION['username']);
        $userSession_id = $this->saveUsernameSession($_SESSION['session_unique']);
        if(empty($username) || empty($userSession_id)){
            session('username',null);
            session('session_unique',null);
            $this->msg = [
                'state' =>2,
                'msg'  => '用户还没有登录'
            ];
            return $this->msg;
        }else{
            $userModel = D('User');
            $where = array('username'=> $username);
            $result  = $userModel->field('id,session_id')->where($where)->find();
            if ($result) {
                if ($result['session_id'] !== $userSession_id) {
                    session('username',null);
                    session('session_unique',null);
                    $this->msg = [
                        'state' =>2,
                        'msg'  => '登录信息已经过期'
                    ];
                    return $this->msg;

                }
                return $result;
            } else {
                session('username',null);
                session('session_unique',null);
                $this->msg = [
                    'state' =>2,
                    'msg'  => '非法登录'
                ];
                return $this->msg;

            }

        }

    }

    protected function saveUsernameSession($name){
        return isset($name) ? $name :null;
    }
}