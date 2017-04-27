<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2016/12/18-1:50
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Home\Controller;

use Classes\UnlimitCate;
use Home\Controller;
use Home\Model\ArticleModel;
use Think\Model;
use Think\Page;

/**
 * 前台首页展示页面
 * Class IndexController
 * @package Home\Controller
 */
class IndexController extends BaseController
{
    private $_limit = 10;  //首页每次提取的文章数目
    private $_state = 2; //返回错误状态，1为成功，2为刷新失败,3为已经返回全部数据
    private $_totalPage =10; //前台首页总共最多可以返回的文章页数
    private $_listRows = 15; //分类页每次提取的文章数


    /**
     * 前台首页模板渲染
     */
    public function index()
    {
        $carouselModel = M('Carousel');
        $carousel = $carouselModel->where(array('status' => 1))->limit(3)->select();
        $this->assign('carousel', $carousel);
        $article = $this->getArticle('',$this->_limit);
        $this->assign('article', $article);
        $hotArticle = $this->getHotArticle();
        $this->assign('hotArticle', $hotArticle);
        $this->assign('totalPage', $this->_totalPage);
        $fast = $this->fast();
        $this->assign('fast',$fast);
        $HotComment =$this->showHotComment();
        $this->assign('HotComment',$HotComment);
        $this->display();
    }

    public function showHotComment()
    {
       $think  =  M('Think');
       return $think->field('id,title,content,href')->limit(8)->select();
    }

    private function fast()
    {
        $fast = M('Fast');
        return $fast->order('time DESC')->limit(10)->select();

    }

    //24快报点赞
    public function addLike()
    {
        if(!IS_AJAX){
            return false;
        }
        $id = I('post.id','','intval');
        $state =  empty($id) ? false : true;
        if($state){
           $fast = M('fast');
           $info  = $fast->field('favorite')->where(array('id'=>$id))->find();
           if($info){
               if ($fast->where(array('id' => $id))->setInc('favorite')) {
                   $fastNum = intval($info['favorite'])+1;
                   $res = [
                       'state' => 1,
                       'fastNum' =>$fastNum

                   ];
                   $this->ajaxReturn($res);
               }


           }
        }

    }


    public function tags()
    {
        $tags = urldecode(I('get.tags','','htmlspecialchars'));
        if(empty($tags)){
            $this->error('标签不能为空',U('Index/index'));
        }
        $articleModel = new ArticleModel();
        $tagsArticle =$articleModel->getTagsArticle($tags,'',$this->_listRows);
        $tagsArticle =$this->articleHandle($tagsArticle);
        $randArticle = $articleModel->getRandArticle();
        $this->assign('randArticle',$randArticle);
        $total = $articleModel->getTagsSum($tags);
        $pagenumber = ceil($total/$this->_listRows);
        $hotArticle = $this->getHotArticle();
        $this->assign('hotArticle',$hotArticle);
        $this->assign('pagenumber',$pagenumber);
        $this->assign('tagsArticle',$tagsArticle);
        $this->assign('tags',$tags);
        $this->display();
    }

    public function ajaxTags()
    {
        if (!IS_AJAX) {
            $this->redirect('Index/index');
        }
        $pageNum = I('post.currey','','intval');
        $tags = I('post.tags','','htmlspecialchars');
        if(empty($tags)){
            $tagsArticle = array();
            $this->ajaxReturn($tagsArticle);
        }else{
            $articleModel = new ArticleModel();
            $start = $pageNum*$this->_listRows-1;
            $tagsArticle =$articleModel->getTagsArticle($tags,$start,$this->_listRows);
            $tagsArticle =$this->articleHandle($tagsArticle);
            $this->ajaxReturn($tagsArticle);
        }
    }



    /**
     * ajax获取更多最新文章
     * @return bool
     */
    public function getMore()
    {
        if(!IS_AJAX){
            return false;
        }
        $pageNum = I('post.pageNum','','intval');
        if(empty($pageNum) || $pageNum <2){
            $this->ajaxReturn($this->_state);
            return false;
        }
        $start  = $this->_limit*$pageNum-1;
        if($start > ($this->_totalPage*$this->_limit-1)){
            $this->_state = 3;
            $this->ajaxReturn($this->_state);
            return false;
        }
        $moreArticle = $this->getArticle($start,$this->_limit);
        if(empty($moreArticle)){
            $this->_state = 3;
            $this->ajaxReturn($this->_state);
            return false;
        }
        $msg = [
            'state'=> 1,
            'moreArticle'=>$moreArticle

        ];
        $this->ajaxReturn($msg);

    }


    /**
     * @param int $start 文章开始的位置
     * @param int $limit 每次返回的文章数目
     * @return mixed 返回排序重组后的文章
     */
    private function getArticle($start = 0,$limit)
    {
        $articleM = new ArticleModel();
        $article = $articleM->getArticle('createtime',$start,$limit);
        return $this->articleHandle($article);

    }

}