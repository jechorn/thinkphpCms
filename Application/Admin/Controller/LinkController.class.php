<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/1/5-6:00
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Admin\Controller;

use Admin\Controller;
use Think\Model;


class LinkController extends BaseController
{
    public function add()
    {
        $this->display();
    }

    public function addLink()
    {
        if (IS_POST) {
            $linkInfo = file_get_contents('php://input');
            $linkInfo = json_decode($linkInfo, JSON_UNESCAPED_UNICODE);
            $data = array();
            foreach ($linkInfo as $k => $v) {

                $data[$k]['name'] = htmlspecialchars($v['name']);
                $data[$k]['url'] = htmlspecialchars($v['url']);
                if (empty($data[$k]['name']) || empty($data[$k]['url'])) {
                    $res = array(
                        'status' => 2,
                        'msg' => '第' . ($k + 1) . '条信息不完整，请重新填写'
                    );
                    $this->ajaxReturn($res);
                    return false;

                } else {
                    if (mb_strlen($data[$k]['name'],'utf8') < 2 || mb_strlen($data[$k]['name'],'utf8') > 5) {
                        $res = array(
                            'status' => 2,
                            'msg' => '第' . ($k + 1) . '条名称长度必须是2-5个字符'
                        );
                        $this->ajaxReturn($res);
                        return false;

                    } else {
                        $preg = "/^(https?:\/\/)?(((www\.)?[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)?\.([a-zA-Z]+))|(([0-1]?[0-9]?[0-9]|2[0-5][0-5])\.([0-1]?[0-9]?[0-9]|2[0-5][0-5])\.([0-1]?[0-9]?[0-9]|2[0-5][0-5])\.([0-1]?[0-9]?[0-9]|2[0-5][0-5]))(\:\d{0,4})?)(\/[\w- .\/?%&=]*)?$/i";
                        $result = preg_match($preg, $data[$k]['url']);
                        if (!$result) {
                            $res = array(
                                'status' => 2,
                                'msg' => '第' . ($k + 1) . '条url地址不合法'
                            );
                            $this->ajaxReturn($res);
                            return false;

                        }

                    }
                }

            }
            $link = M('Link');
            $linkData = $link->select();
            if (!empty($linkData)) {
                $row = $link->execute('truncate table  `link`');
                if ($row) {
                    $res = array(
                        'status' => 2,
                        'msg' => '友情链接更新失败'
                    );
                    $this->ajaxReturn($res);
                    return false;
                } else {
                    $link->startTrans();
                    if ($link->addAll($data)) {
                        $link->commit();
                        $res = array(
                            'status' => 1,
                            'msg' => '数据添加成功'
                        );
                        $this->ajaxReturn($res);
                    } else {
                        $link->rollback();
                        $res = array(
                            'status' => 2,
                            'msg' => '数据添加失败'
                        );
                        $this->ajaxReturn($res);
                    }
                }
            } else {
                $link->startTrans();
                if ($link->addAll($data)) {
                    $link->commit();
                    $res = array(
                        'status' => 1,
                        'msg' => '数据添加成功'
                    );
                    $this->ajaxReturn($res);
                } else {
                    $link->rollback();
                    $res = array(
                        'status' => 2,
                        'msg' => '数据添加失败'
                    );
                    $this->ajaxReturn($res);
                }
            }

        } else {
            $this->redirect('Link/add');
        }
    }


}