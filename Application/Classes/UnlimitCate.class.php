<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/1/10-9:09
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Classes;


class UnlimitCate{

    /**
     * @description 处理成多维数组
     * @param $data 需要处理的原始数组
     * @param int $pid 父级的ID
     * @param $name  压缩的子数组的键名
     */
    public function unlimitedMultiCate($data, $pid = 0){
        $arr = array();
        foreach ($data as $v) {
            if ($v['pid'] == $pid) {
                $v['child'] = self::unlimitedCate($data, $v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }

    /**
     * @param $data 需要处理的数组
     * @param int $pid 父级的ID
     * @param $html 添加的html内容
     * @param int $level 分类的等级，父级是0
     */
    public function unlimitOneCate($data,$pid=0,$level=0,$html='--'){
        $arr =array();
        foreach ($data as $v){
            if ($v['pid'] == $pid) {
                $v['level']== $level;
                $v['html'] = str_repeat($html,$level*1);
                $arr[] =$v;
                $arr = array_merge($arr,self::unlimitOneCate($data,$v['id'],$level+1));
            }
        }
        return $arr;
    }

    /**
     * @param $data 需要处理的数组
     * @param $id 需要处理的元素的ID
     * @return array 返回该ID所有子孙的一维数组
     */
    public function getChildrens($data,$id){
        $arr =array();
        foreach ($data as $v){
            if($v['pid']==$id){
                $arr[] = $v;
                $arr = array_merge($arr,self::getChildrens($data,$v['id']));
            }
        }
        return $arr;
    }


    /**
     * @param $data 需要处理的数组
     * @param $pid  需要处理的元素的pid
     * @return array 返回该元素的所有父级元素组成的一维数组
     */
    public function getParents($data,$pid){
        $arr = array();
        foreach ($data as $v){
            if($v['id'] == $pid){
                $arr[] = $v;
                $arr =array_merge($arr,self::getParents($data,$v['pid']));
            }
        }
        return $arr;
    }




}