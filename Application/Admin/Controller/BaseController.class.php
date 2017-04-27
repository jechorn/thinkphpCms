<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2016/12/18-1:44
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Admin\Controller;

use Think\Controller;


class BaseController extends Controller
{
    protected $_adminName;

    public function _initialize()
    {
        $user = $this->saveCurreySession($_SESSION['adminname']);
        $session_id = $this->saveCurreySession($_SESSION['session_id']);
        if (empty($user) || empty($session_id)) {
            session('adminname', null);
            session('session_id', null);
            $this->error('您尚没有登录，请重新登录', U('Login/index'));
            exit;
        }
        if (!empty($user) && !empty($session_id)) {
            $admin = M('Admin');
            $where = array('adminname' => $user);
            $result = $admin->where($where)->find();
            if ($result) {
                if (!($result['session_id'] == $session_id)) {
                    session('adminname', null);
                    session('session_id', null);
                    $this->error('你的登录信息过期', U('Login/index'));
                    exit;
                }
            } else {
                session('adminname', null);
                session('session_id', null);
                $this->error('非法登录！', U('Login/index'));
                exit;
            }
        }
        $this->_adminName = $user;
        $this->assign('adminName', $this->_adminName);

    }

    private function saveCurreySession($name)
    {
        return isset($name) ? $name : null;
    }

}