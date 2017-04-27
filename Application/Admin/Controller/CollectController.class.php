<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/4/1-7:49
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Admin\Controller;

use QL\QueryList;
use Think\Controller;

/**
 * 文章信息的抓取
 * Class CollectController
 * @package Admin\Controller
 */
class CollectController extends BaseController
{
    public function index()
    {
        $rules = array(
           'link' =>array('.mod-thumb a','href')
        );
        $data =QueryList::Query('https://www.huxiu.com/',$rules)->getData(function ($items){
            $items['link']  = 'https://www.huxiu.com'.$items['link'];

            if(preg_match('/article/i',$items['link'])){
                $rule =array(
                    'title' =>array('.article-wrap .t-h1','text'),
                    'content' =>array('.article-content-wrap','html','-.neirong-shouquan -.neirong-shouquan-public'),
                    'tags' =>array('.tag-box ul','html')
                );
                $info = QueryList::Query($items['link'],$rule)->getData(function ($item){
                    $tag_rule =array(
                        'item' =>array('li','text')
                    );
                    $item['tags'] =QueryList::Query($item['tags'],$tag_rule)->data;
                    $tags = [];
                    foreach ($item['tags'] as $v){
                        $tags[] = $v['item'];

                    }
                    $item['tags'] =implode('|',$tags);

                    return $item;
                });
                return $info;
            }else{
                unset($items);
            }

        });

        foreach ($data as $v) {
            if (!empty($v)) {
                $addData['content'] =$v[0]['content'];
                $addData['title'] =$v[0]['title'];
                $addData['tags'] =$v[0]['tags'];
                $addData['createtime'] =time();
                $rand = array(222,223,224,225,226,227);
                $a =array_rand($rand,1);
                $addData['cid'] =$rand[$a];
                $article =M('Article');
                $article->add($addData);
            }
        }
        echo '已经操作成功';
    }


    public function joke()
    {

        $rules = array(
            'link' =>array('.item-intro a','href')
        );
        $data =QueryList::Query('http://www.cyzone.cn/',$rules)->getData(function ($items){

                $rule =array(
                    'title' =>array('.article-tit','text'),
                    'content' =>array('.article-content','html',),
                    'tags' =>array('.article-tags:eq(0)','html','-span')
                );
                $info = QueryList::Query($items['link'],$rule)->getData(function ($item){
                    $tag_rule =array(
                        'item' =>array('.tag-link','text')
                    );
                    $item['tags'] =QueryList::Query($item['tags'],$tag_rule)->data;
                    $tags = [];
                    foreach ($item['tags'] as $v){
                        $tags[] = $v['item'];

                    }
                    $item['tags'] =implode('|',$tags);

                    return $item;
                });
                return $info;
        });

        foreach ($data as $v) {
            if (!empty($v)) {
                $addData['content'] =$v[0]['content'];
                $addData['title'] =$v[0]['title'];
                $addData['tags'] =$v[0]['tags'];
                $addData['createtime'] =time();
                $rand = array(222,223,224,225,226,227);
                $a =array_rand($rand,1);
                $addData['cid'] =$rand[$a];
                $article =M('Article');
                $article->add($addData);
            }
        }

        echo '已经操作成功';
    }

    /**
     * 创业邦信息的抓取
     */
    public function chuanye()
    {
        for ($i=110;$i++;$i<10) {
            $url = 'http://www.cyzone.cn/category/766/index_'.$i.'.html';
            $rules = array(
                'link' =>array('.item-intro a','href')
            );
            $data =QueryList::Query($url,$rules)->getData(function ($items){

                $rule =array(
                    'title' =>array('.article-tit','text'),
                    'content' =>array('.article-content','html',),
                    'tags' =>array('.article-tags:eq(0)','html','-span')
                );
                $info = QueryList::Query($items['link'],$rule)->getData(function ($item){
                    $tag_rule =array(
                        'item' =>array('.tag-link','text')
                    );
                    $item['tags'] =QueryList::Query($item['tags'],$tag_rule)->data;
                    $tags = [];
                    foreach ($item['tags'] as $v){
                        $tags[] = $v['item'];

                    }
                    $item['tags'] =implode('|',$tags);

                    return $item;
                });
                return $info;

            });

            foreach ($data as $v) {
                if (!empty($v)) {
                    $addData['content'] =$v[0]['content'];
                    $addData['title'] =$v[0]['title'];
                    $addData['tags'] =$v[0]['tags'];
                    $addData['createtime'] =time();
                    $rand = array(222,223,224,225,226,227);
                    $a =array_rand($rand,1);
                    $addData['cid'] =$rand[$a];
                    $article =M('Article');
                    $article->add($addData);
                }
            }


        }
        echo '已经操作成功';
    }

    public function kuai()
    {
        $rules = array(
            'title' =>array('.item-intro .item-title','text'),
            'content'=>array('.item-desc p','text')
        );
        $data =QueryList::Query('http://www.cyzone.cn/category/8/',$rules)->getData(function ($items){
            return $items;
        });

        foreach ($data as $v) {
                $addData['content'] =$v['content'];
                $addData['title'] =$v['title'];
                $addData['time'] =time();
                $article =M('fast');
                $article->add($addData);

        }
        echo '已经操作成功';
    }


    public function hot()
    {
        $rules = array(
            'link' =>array('.ry-content .title a','href')
        );
        $data =QueryList::Query('https://www.huxiu.com/topic_list',$rules)->getData(function ($items){
            $items['link']  = 'https://www.huxiu.com'.$items['link'];

            $rule =array(
                'title' =>array('.t-h1','text'),
                'content' =>array('.ry-content-box','text',),

            );
            $items['list'] = QueryList::Query($items['link'],$rule)->getData(function ($item){

                return $item;
            });
            return $items;




        });

        foreach ($data as $v) {
            if (!empty($v)) {
                $addData['content'] =$v['list'][0]['content'];
                $addData['title'] =$v['list'][0]['title'];
                $addData['time'] =time();
                $addData['href'] =$v['link'];
                $arr[] = $addData;
                $article =M('Think');
                $article->add($addData);

            }
        }

        echo '已经操作成功';
    }
}