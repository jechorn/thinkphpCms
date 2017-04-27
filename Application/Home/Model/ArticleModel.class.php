<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/3/24-8:24
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Home\Model;


use Think\Model;

class ArticleModel extends Model\RelationModel
{
    private $listRows = 15;
    protected $tableName = 'Article';
    protected $_link = array(
        'Attr' => array(
            'mapping_type' => self::MANY_TO_MANY,
            'foreign_key' => 'cid',
            'relation_foreign_key' => 'aid',
            'relation_table' => 'article_attr' //此处应显式定义中间表名称，且不能使用C函数读取表前缀


        ),
        'Like' => array(
            'mapping_type' => self::HAS_MANY,
            'foreign_key' => 'cid',
            'mapping_fields'=>'ip'

        )
    );

    /**
     * @param $order 需要排序的字段
     * @param $start 返回文章的开始索引
     * @param $limit 限制返回的文章数量
     * @return mixed 返回的文章
     */
    public function getArticle($order, $start, $limit)
    {
        $articleData = $this->where(array('delete' => 0))->field('id,title,image,content,click,tags,createtime,favorite')->relation('Attr')->order("$order DESC")->limit($start, $limit)->select();
        return $articleData;
    }

    /**
     * 返回热文
     * @param $limit
     */
    public function getHotArticle($limit)
    {
        $hotArticle = $this->field('id,title,content,image')->order('click DESC')->limit($limit)->select();
        return $hotArticle;
    }

    /**
     * @param $id 文章的id
     */
    public function getArticleDetail($id)
    {
        $detail = $this->where(array('id' => $id))->field()->find();
        return $detail;
    }


    /**
     * @param $match 文章的子分类与父分类的组合
     * @return Model
     */
    public function getMatchArticle($match)
    {
        $map['cid'] = array('in', $match);
        $matchArticle = $this->where($map)->field('id,title,image,content')->order('click DESC')->limit(6)->select();
        return $matchArticle;
    }

    /**
     * 返回文章下所有分类的文章
     * @param $map $map['cid']  = array('in','1,2,3');
     * @param $start =0 开始位置，默认从第一条开始
     * @param $listRows 每页条数
     * @return mixed
     */
    public function getCateArticle($map, $start = 0, $listRows)
    {
        //$map['cid']  = array('in',$match);
        $ListArticle = $this->where($map)->relation(true)->field('id,title,createtime,tags,image,content,click')->order('createtime DESC')->limit($start, $listRows)->select();
        return $ListArticle;
    }

    /**
     * 返回该分类cid所有的子级分类和父级分类的数量
     * @param $map $map['cid']  = array('in','1,2,3');
     * @return mixed
     */
    public function cateListSum($map)
    {
        //$map['cid']  = array('in',$match);
        return $this->where($map)->count();
    }

    /**
     * 返回随机文章
     * @return mixed
     */
    public function getRandArticle()
    {
        $randArticle = $this->field('id,title')->order('click DESC')->limit(30)->select();

        $randArticleKey = array_rand($randArticle, 10);
        $arr = [];
        foreach ($randArticleKey as $v) {
            $arr[] = $randArticle[$v];
        }
        return $arr;

    }

    /**
     * 点赞IP获取
     * @param $id 文章的ID
     * @return mixed
     */
    public function getLike($id)
    {
        $like = $this->relation('Like')->where(array('id'=>$id))->field('id')->find();
        return $like['Like'];
    }

    /**
     * 点赞IP记录
     * @param $data
     * @return mixed
     */
    public function setLike($data)
    {
        $like = M('Like');
        return $like->add($data);

    }

    /**
     * @param $tags 搜索的tags名称
     * @param $start 数据开始的位置
     * @param $limit 返回数据的数量
     * @return mixed
     */
    public function getTagsArticle($tags,$start=0,$limit)
    {
        $map['tags'] =array('like',"%$tags%");
        $map['delete'] = 0;
        $tagArticle = $this->where($map)->field('id,tags,cid,title,createtime,click,content,image')->limit($start,$limit)->select();
        return $tagArticle;
    }

    public function getTagsSum($tags)
    {
        $map['tags'] =array('like',"%$tags%");
        $map['delete'] = 0;
        return $this->where($map)->count();
    }
}