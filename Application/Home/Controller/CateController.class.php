<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/4/12-13:29
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Home\Controller;

use Home\Model\ArticleModel;
use Think\Controller;

/**
 * Class CateController
 * @package Home\Controller
 * 分类列表控制器
 */
class CateController extends BaseController
{
    private $_limit = 10;  //首页每次提取的文章数目
    private $_state = 2; //返回错误状态，1为成功，2为刷新失败,3为已经返回全部数据
    private $_totalPage =10; //前台首页总共最多可以返回的文章页数
    private $_listRows = 15; //分类页每次提取的文章数
    //分类页展示
    public function index()
    {
        $id = I('get.id','','intval');
        if(empty($id)){
            $map =array();

            //$this->error('无效操作',U('Index/index'));
        }else{
            $match = $this->matchCate($id);
            $map['cid']  = array('in',$match);
        }

        //$match = empty($id) ? array() : $this->matchCate($id);
        $articleModel = new ArticleModel();
        //返回该分类下的文章
        $cateArticle = $articleModel->getCateArticle($map,'',$this->_listRows);
        $cateArticle = $this->articleHandle($cateArticle);
        $this->assign('cateArticle',$cateArticle);
        $randArticle = $articleModel->getRandArticle();
        $this->assign('randArticle',$randArticle);
        $totalList = $articleModel->cateListSum($map);
        $pagenumber = ceil($totalList/$this->_listRows);
        $hotArticle = $this->getHotArticle();
        $this->assign('hotArticle',$hotArticle);
        $this->assign('pagenumber',$pagenumber);
        $this->assign('cid',$id);
        $this->display();
    }
    //分类页ajax处理
    /**
     * ajax返回该分类下的文章
     */
    public function ajaxHandle()
    {
        if (!IS_AJAX) {
            $this->redirect('Index/index');
        }
        $pageNum = I('post.currey','','intval');
        $cid = I('post.cid','','intval');
        if(empty($id)){
            $map =array();
            //$this->error('无效操作',U('Index/index'));
        }else{
            $match = $this->matchCate($cid);
            $map['cid']  = array('in',$match);
        }

        //$match = $this->matchCate($cid);
        $articleModel = new ArticleModel();
        $start = $pageNum*$this->_listRows-1;
        $cateArticle = $articleModel->getCateArticle($map,$start,$this->_listRows);
        $cateArticle = $this->articleHandle($cateArticle);
        $this->ajaxReturn($cateArticle);

    }

}