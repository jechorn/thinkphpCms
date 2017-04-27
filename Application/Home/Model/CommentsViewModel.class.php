<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/4/18-8:11
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Home\Model;


use Think\Model;

class CommentsViewModel extends Model\ViewModel
{
    public $viewFields = array(
        'Comments' => array('id','comment','up','down','time','uid'),
        'User' =>array('image','username','_on'=>'Comments.uid = User.id','_type'=>'RIGHT'),
    );
    /**
     * @param $aid 文章的ID;
     * @param $limit 每次取出的数据量;
     * @param $type 获取评论的排列方式;
     * 1为默认按照点赞数排序，2为按照最新评论排序;
     */
    public function getComments($aid ,$type = 1,$limit=10)
    {
        $order ='up DESC';
        switch ($type){
            case 1:
                $order = 'up DESC';
                break;
            case 2:
                $order = 'time DESC';
                break;
        }
        return $this->where(array('aid'=>$aid))->field('id,comment,up,down,time,uid,image,username')->order($order)->limit($limit)->select();

    }

    /**
     * @param $data $data为数组；有三个键值对，分别为id=>评论的id; aid=>文章的id; type=>点赞还是踩踩
     * @return bool
     */
    public function setLike($data){
        switch ($data['type']){
            case 1:
                return $this->where(array('aid'=>$data['aid'],'id'=>$data['id']))->setInc('up',1);
                break;
            case 2:
                return $this->where(array('aid'=>$data['aid'],'id'=>$data['id']))->setInc('down',1);
                break;
            default:
                break;
        }
    }


}