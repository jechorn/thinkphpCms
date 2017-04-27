<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/1/20-7:28
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Admin\Model;

use Think\Model\RelationModel;

class ArticleModel extends RelationModel
{
    protected $tableName = 'Article';
    protected $_link = array(
        'Attr' => array(
            'mapping_type' => self::MANY_TO_MANY,
            'foreign_key' => 'cid',
            'relation_foreign_key' => 'aid',
            'relation_table' => 'article_attr' //此处应显式定义中间表名称，且不能使用C函数读取表前缀


        ),
    );
    protected $_validate = array(
        array('title', 'require', '文章标题不能为空'),
        array('title', '10,30', '文章标题长度必须在10到30个字符之间', 0, 'length'),
        array('click', 'number', '只能输入数字'),
        array('cid', 'number', '只能输入数字'),
        array('content', 'require', '文章内容不能为空')
    );


    /**
     * @description 是否移出回收站的数据操作
     * @param $id    需要操作的文章ID
     * @param $data  修改的数据数组
     * @param $msg   返回的信息
     * @return array 返回的数组信息
     */
    public function trashHandle($id, $data, $msg)
    {

        $where = array('id' => $id);
        if ($this->where($where)->save($data)) {
            $res = [
                'state' => 'ok',
                'msg' => $msg

            ];


        } else {
            $res = [
                'state' => 'error',
                'msg' => '操作失败，请重新操作！'

            ];
        }
        return $res;

    }


    /**
     * @description 彻底删除文章的数据操作
     * @param $id  删除文章的ID
     * @return mixed  返回是否删除成功的信息
     */
    public function deleteArticle($id)
    {
        $result = $this->relation(true)->delete($id);
        return $result;

    }

}