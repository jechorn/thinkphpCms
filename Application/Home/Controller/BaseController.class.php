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

namespace Home\Controller;

use Home\Model\BaseModel;
use Think\Model;
use Think\Controller;
use Classes\UnlimitCate;
use Home\Model\ArticleModel;

class BaseController extends Controller
{
    public function _initialize()
    {
        $checkSql = new BaseModel();
        $nav = $checkSql->getNav();
        $link = $checkSql->getLink();
        $system = $checkSql->getSystem();
        $this->assign('nav', $nav);
        $this->assign('link', $link);
        $this->assign('system', $system);


    }

    public function _empty(){
        header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码
        $this->display("Public:404");
    }
    /**
     * 查询某个分类id所有相关的子分类和父级分类的组合
     * @param $id
     * @return string
     */
    protected function matchCate($id)
    {
        $category = M('Category');
        $cate = $category->field('id,pid')->select();
        $unLimitCate = new UnlimitCate();
        $childrens = $unLimitCate->getChildrens($cate,$id);
        $parents = $unLimitCate->getParents($cate,$id);
        $match = array_merge($childrens, $parents);
        $arr = [];
        foreach ($match as $k => $v) {
            $arr[] =$v['id'];
        }
        return $match = implode(',',$arr);
    }


    /**
     * @param $article 需要进行处理的文章数组
     * @return mixed
     */
    protected function articleHandle($article)
    {
        $arr = [];
        $tagsArray = [];

        foreach ($article as $k => $v) {
            $article[$k]['createtime'] =diffTime($v['createtime']);
            if(empty($v['image'])){
                $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png])(\?.*?)*)[\'|\"].*?[\/]?>/";
                $content = $v['content']; //文章内容
                if(preg_match($pattern,$content,$matchImage)){
                    $article[$k]['image'] = $matchImage[1];

                }else{
                    $article[$k]['image']=__ROOT__."/Public/images/thumb.jpg";
                }
            }else {
                $article[$k]['image'] =__ROOT__.'/'.$article[$k]['image'];
            }
            $article[$k]['content'] = strip_tags($v['content']);
            $article[$k]['content'] = mb_substr($article[$k]['content'],0,100,'utf-8');
            $tagsArray = explode('|', $v['tags']);
            $article[$k]['tags'] = array_filter($tagsArray);
            if (!empty($v['Attr'])) {
                foreach ($v['Attr'] as $key => $value) {
                    if ('置顶' == $value['name']) {
                        $arr[] = $article[$k];
                        unset($article[$k]);

                    }
                    if('推荐' == $value['name']){
                        $article[$k]['hot'] ='推荐';
                    }

                }

            }

        }
        $article = array_merge($arr, $article);
        return $article;
    }
    /**
     * 返回热文
     * @param $limit
     */
    protected function getHotArticle($limit =10)
    {
        $articleModel = new ArticleModel();
        $hotArticle = $articleModel->getHotArticle($limit);
        $arr = [];
        foreach ($hotArticle as $k => $v) {
            if(empty($v['image'])){
                $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png])(\?.*?)*)[\'|\"].*?[\/]?>/";
                $content = $v['content']; //文章内容
                if(preg_match($pattern,$content,$matchImage)){
                    $hotArticle[$k]['image'] = $matchImage[1];

                }
            }else {
                $hotArticle[$k]['image'] =__ROOT__.'/'.$hotArticle[$k]['image'];
            }
        }
        return $hotArticle;

    }
    /**
     * 详情页右边侧栏随机文章
     */
    public function randArticle()
    {
        if(!IS_AJAX){
            $this->ajaxReturn($this->_state);
        }
        $articleModel = new ArticleModel();
        $randArticle = $articleModel->getRandArticle();
        if($randArticle){
            $msg =[
                'state'=>1,
                'randArticle'=>$randArticle
            ];
            $this->ajaxReturn($msg);
        }

    }


}