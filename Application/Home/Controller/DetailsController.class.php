<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/4/12-13:32
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Home\Controller;


use Home\Model\CommentsViewModel;
use Think\Controller;
use Home\Model\ArticleModel;
use Home\Controller\BaseController;

class DetailsController extends BaseController
{
    private $_state = 2; //返回错误状态，1为成功，2为刷新失败,3为已经返回全部数据

    /**
     * 文章详情展示页
     */
    public function detail()
    {
        $id = I('get.id', '', 'intval');
        if(empty($id)){
            $this->error('找不到文章',U('Index/index'));

        }
        $articleModel = new ArticleModel();
        $detail = $articleModel->getArticleDetail($id);
        if ($detail) {
            $where =array('id'=>$id);
            $articleModel->where($where)->setInc('click',1);
            $match = $this->matchCate($detail['cid']);
            $matchArticle = $this->getMatchArticle($match);
            if(empty($matchArticle)){
                $hotArticle = $this->getHotArticle(6);
                $this->assign('hotArticle',$hotArticle);
            }
            $this->assign('matchArticle',$matchArticle);
            $hotArticle = $this->getHotArticle();
            $this->assign('hotArticle',$hotArticle);
            $randArticle = $articleModel->getRandArticle();
            $this->assign('randArticle',$randArticle);
            $this->assign('detail',$detail);
            $commentsModel = new CommentsViewModel();
            $comments = $commentsModel->getComments($id);
            $this->assign('comments',$comments);
            $this->display();
        }else{
            $this->error('不存在此文章',U('Index/index'));
        }

    }
    /**
     * 返回相关文章
     * @param $match 文章的子分类与父分类的cid组合，为字符串
     * @return Model
     */
    public function getMatchArticle($match)
    {
        $articleModel = new ArticleModel();
        $matchArticle = $articleModel->getMatchArticle($match);
        foreach ($matchArticle as $k => $v) {
            if(empty($v['image'])){
                $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png])(\?.*?)*)[\'|\"].*?[\/]?>/";
                $content = $v['content']; //文章内容
                if(preg_match($pattern,$content,$matchImage)){
                    $matchArticle[$k]['image'] = $matchImage[1];

                }else{
                    $matchArticle[$k]['image']=__ROOT__."/Public/images/thumb.jpg";
                }
            }else {
                $matchArticle[$k]['image'] =__ROOT__.'/'.$matchArticle[$k]['image'];
            }
        }

        return $matchArticle;
    }



    /**
     * 文章点赞
     */
    public function like()
    {
        $id   = I('post.id' , '' , 'intval');
        if(empty($id)){
            $msg =[
                'state' => $this->_state,
                'msg' =>'无效操作'
            ];
            $this->ajaxReturn($msg);
            return;
        }
        $articleModel = new ArticleModel();

        if($articleModel->getLike($id)){
            $msg =[
                'state' => $this->_state,
                'msg' =>'你已点赞过'
            ];
            $this->ajaxReturn($msg);
            return;
        }else{
            $data['id'] = $id;
            $data['favorite'] =array('exp','favorite+1');
            $articleModel->save($data);
            $like['cid'] =$id;
            $like['ip'] = getIp();
            $articleModel->setLike($like);
            $favorite = $articleModel->where(array('id'=>$id))->field('favorite')->find();
            $msg =[
                'state' =>  1 ,
                'favorite' =>intval($favorite['favorite']),
                'msg' =>'您刚点了个赞'
            ];

            $this->ajaxReturn($msg);

        }

    }



}