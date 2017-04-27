<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/1/18-16:42
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Admin\Controller;

use Admin\Controller;
use Classes\UnlimitCate;
use Admin\Model;
use Think\Page;
use Think\Upload;


class ArticleController extends BaseController
{
    private $_info;   //上传文件返回信息
    private $_data = array();
    private $_msg;
    public $listRows = 15;
    public $totalRows;
    public $totalPages;

    /**
     * 文章列表页
     */
    public function index()
    {
        $url = U('Article/trashList');
        $this->assign('url', $url);
        $this->showArticle(0);

    }

    /**
     * 回收站文章列表
     */
    public function trashList()
    {
        $url  = U('Article/index');
        $this->assign('url', $url);
        $this->showArticle(1, index);


    }

    /**
     * @param int $delete 传值，文章是否已经被放入回收站，0为没有；1为已经放入回收站；默认是0
     * @param  $html 需要渲染的模板
     */
    private function showArticle($delete = 0, $html = '')
    {
        $this->totalPages = $this->getTotalPages($delete);
        $this->assign('pages', $this->totalPages);
        $this->article = M('Article')->where(array('delete' => $delete))->order('id')->limit($this->listRows)->select();
        $this->assign('article', $this->article);
        $this->display($html);
    }

    /**
     * 文章添加
     */
    public function add()
    {
        //文章属性
        $this->attr = M('Attr')->order('id')->select();
        $cate = M('Category')->order('sort')->field(array('id', 'name', 'pid'))->select();
        $unlimitCate = new UnlimitCate();
        $this->cate = $unlimitCate->unlimitOneCate($cate);
        $this->display();

    }

    /**
     * 文章修改
     */
    public function update()
    {
        if (!empty($_GET['id']) && intval($_GET['id'])) {
            $article = D('Article')->relation(true)->find(intval($_GET['id']));
            if (!$article) {
                $this->redirect('Article/index');

            }
            $this->assign('article',$article);
            $this->attr = M('Attr')->order('id')->select();
            $cate = M('Category')->order('sort')->field(array('id', 'name', 'pid'))->select();
            $unlimitCate = new UnlimitCate();
            $this->cate = $unlimitCate->unlimitOneCate($cate);
            $this->display();
        }

    }


    /**
     * 文章主图上传
     */

    private function uploadImg()
    {
        $config = array(
            'maxSize' => 2097152, //上传的文件大小限制 (0-不做限制)
            'exts' => array('jpg', 'gif', 'jpeg', 'png'), //允许上传的文件后缀
            'rootPath' => './Uploads/', //保存根路径
            'savePath' => '', //保存路径
        );
        $upload = new Upload($config);
        $info = $upload->upload();
        if (!$info) {
            $this->_info = array(
                'state' => 2,
                'msg' => $upload->getError()
            );
            return false;

        } else {
            $this->_info = 'Uploads/' . $info['files']['savepath'] . $info['files']['savename'];
            return true;
        }

    }

    /**
     *上传图片返回信息
     */
    private function getImgMsg()
    {
        return $this->_info;
    }


    /**
     * @return mixed
     * 返回文章添加数据项
     */
    private function getArticleData()
    {
        return $this->_data;
    }


    private function updateArticle()
    {
        $article = D('Article');
        $data = $this->getArticleData();
        $data['id'] = I('post.id', 0, 'intval');

        if ($article->create($data)) {
            $success = array(
                'state' => 'ok',
                'msg' => '文章信息修改成功'
            );
            $error = array(
                'state' => 'error',
                'msg' => '文章信息修改失败'
            );

            $article->startTrans();
            if ($article->save($data)) {
                $articleAttr = M('article_attr');
                $articleAttr->where(array('cid' => $data['id']))->delete();
                if (isset($_POST['attr'])) {
                    $arr = array();
                    foreach ($_POST['attr'] as $k => $v) {
                        $arr[$k]['aid'] = intval($v);;
                        $arr[$k]['cid'] = $data['id'];
                    }
                    $info = $articleAttr->addAll($arr);
                    if ($info) {
                        $article->commit();
                        $this->_msg = $success;
                    } else {
                        $article->rollback();
                        $this->_msg = $error;
                    }

                } else {
                    $article->commit();
                    $this->_msg = $success;
                }

            } else {
                $this->_msg = $error;
            }

        } else {
            $this->_msg = array(
                'state' => 'error',
                'msg' => $article->getError()
            );

        }
        $this->ajaxReturn($this->_msg);

    }


    /**
     * 文章插入数据库处理
     */
    private function addArticle()
    {
        $article = D('Article');
        $data = $this->getArticleData();
        if ($article->create($data)) {
            $success = array(
                'state' => 'ok',
                'msg' => '文章信息添加成功'
            );
            $error = array(
                'state' => 'error',
                'msg' => '文章信息添加失败'
            );

            $article->startTrans();
            if ($id = $article->add()) {

                if (isset($_POST['attr'])) {
                    $articleAttr = M('article_attr');
                    $arr = array();
                    foreach ($_POST['attr'] as $k => $v) {
                        $arr[$k]['aid'] = intval($v);;
                        $arr[$k]['cid'] = $id;
                    }
                    $info = $articleAttr->addAll($arr);
                    if ($info) {
                        $article->commit();
                        $this->_msg = $success;
                    } else {
                        $article->rollback();
                        $this->_msg = $error;
                    }
                } else {
                    $article->commit();
                    $this->_msg = $success;
                }


            } else {
                $this->_msg = $error;
            }

        } else {
            $this->_msg = array(
                'state' => 'error',
                'msg' => $article->getError()
            );

        }
        $this->ajaxReturn($this->_msg);


    }


    /**
     * 文章内容添加处理
     */
    public function addHandle()
    {
        if (IS_AJAX) {


            $this->_data['title'] = I('post.name', '', 'htmlspecialchars');
            $this->_data['tags'] = I('post.tags', '', 'htmlspecialchars');
            $this->_data['click'] = I('post.click', '', 'intval');
            $this->_data['cid'] = I('post.cid', '', 'intval');
            $this->_data['image'] = I('post.image', '', 'htmlspecialchars');
            $this->_data['createtime'] = time();
            $this->_data['content'] = isset($_POST['content']) ? $_POST['content'] : '';


            if (empty($_FILES) || $_FILES['files']['error'] == 4) {

                $this->addArticle();

            } else {
                if ($this->uploadImg()) {
                    $this->_data['image'] = $this->getImgMsg();
                    $this->addArticle();

                } else {
                    $this->ajaxReturn($this->getImgMsg());
                }
            }

        } else {
            $this->redirect('Article/add');
        }


    }

    /**
     * 文章修改处理
     */
    public function updateHandle()
    {
        if (IS_AJAX) {

            $this->_data['title'] = I('post.name', '', 'htmlspecialchars');
            $this->_data['tags'] = I('post.tags', '', 'htmlspecialchars');
            $this->_data['click'] = I('post.click', '', 'intval');
            $this->_data['cid'] = I('post.cid', '', 'intval');
            $this->_data['image'] = I('post.image', '', 'htmlspecialchars');
            $this->_data['createtime'] = time();
            $this->_data['content'] = isset($_POST['content']) ? $_POST['content'] : '';

            if (empty($_FILES) || $_FILES['files']['error'] == 4) {

                $this->updateArticle();

            } else {
                if ($this->uploadImg()) {
                    $this->_data['image'] = $this->getImgMsg();
                    $this->updateArticle();

                } else {
                    $this->ajaxReturn($this->getImgMsg());
                }
            }

        } else {
            $this->redirect('Article/add');
        }


    }

    /**
     * 文章放入移出回收站操作
     */
    public function trash()
    {
        if (!IS_AJAX) {
            $this->redirect('Article/index');
        }
        $id = I('post.id', 0, 'intval');
        $handleType = I('post.handle', '', 'intval');
        $article = D('Article');

        switch ($handleType) {
            case 1:
                $data['delete'] = 1;
                $msg = '已放入回收站';
                $res = $article->trashHandle($id, $data, $msg);

                break;
            case 2:
                $data['delete'] = 0;
                $msg = '已移出回收站';
                $res = $article->trashHandle($id, $data, $msg);
                break;
            default:
                $msg = '未知错误,请重新操作';
                $res = [
                    'state' => 'error',
                    'msg' => $msg

                ];

        }

        $this->ajaxReturn($res);

    }

    /**
     * 彻底删除文章操作
     */
    public function delete()
    {
        if (!IS_AJAX) {
            $this->redirect('Article/index');
        }
        $id = I('post.id', 0, 'intval');
        $handleType = I('post.handle', '', 'intval');
        if ($handleType == 3) {
            $article = D('Article');
            if ($article->deleteArticle($id)) {
                $res = [
                    'state' => 'ok',
                    'msg' => '文章删除成功！'

                ];
            } else {
                $res = [
                    'state' => 'ok',
                    'msg' => '文章删除失败，请重新操作！'

                ];
            }

        } else {
            $res = [
                'state' => 'error',
                'msg' => '未知错误,请重新操作！'

            ];
        }
        $this->ajaxReturn($res);

    }


    /**
     ** @param int $delete 文章是否已经放入回收站，0为没有放入，1为已经放进回收站，默认是0;
     * @return mixed 返回总页数；
     */
    private function getTotalNum($delete = 0)
    {
        $article = D('Article');
        $this->totalRows = $article->where(array('delete' => $delete))->count();  //文章总记录数
        return $this->totalRows;
    }

    /**
     * @param int $delete 文章是否已经放入回收站，0为没有放入，1为已经放进回收站，默认是0;
     * @return float
     */
    private function getTotalPages($delete = 0)
    {
        $this->totalRows = $this->getTotalNum($delete);
        return ceil($this->totalRows / $this->listRows);
    }


    public function getPage()
    {
        if (!IS_AJAX) {
            $this->redirect('Article/index');
        }

        $curreyPage = I('post.currey', 1, 'intval');
        $handleName = I('post.handleName', '', 'htmlspecialchars');

        $delete = (('index' == $handleName) ? 0 : 1);

        $this->totalRows = $this->getTotalNum($delete);
        $this->totalPages = $this->getTotalPages($delete);


        if ($curreyPage > $this->totalPages) {
            $curreyPage = $this->totalPages;
        }
        if ($curreyPage <= 0) {
            $curreyPage = 1;
        }
        $rows = $this->listRows;
        if ($curreyPage == $this->totalPages) {
            $rows = $this->totalRows - ($this->totalPages - 1) * $this->listRows;
        }

        $article = D('Article');
        $data = $article->where(array('delete' => $delete))->order('id')->limit($this->listRows * ($curreyPage - 1), $rows)->select();

        $this->ajaxReturn($data);

    }


}