<?php
/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2017/3/19-0:46
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Admin\Controller;


use Think\Controller;

class TestController extends Controller
{
    public function index()
    {

        $b = Array(
            'photo' => Array(
                'name' => Array(              //$_FILES["myfile"]["name"]存储所有上传文件的内容
                    0 => 'Rav.ini',         //$_FILES["myfile"]["name"][0]第一个上传文件的名称
                    1 => 'msgsocm.log',    //$_FILES["myfile"]["name"][1]第二个上传文件的名称
                    2 => 'NOTEPAD.EXE'
                ),     //$_FILES["myfile"]["name"][2]第三个上传文件的名称
                'type' => Array(               //$_FILES["myfile"]["type"]存储所有上传文件的类型
                    0 => 'application/octet-stream',        //$_FILES["myfile"]["type"][0]第一个上传文件的类型
                    1 => 'application/octet-stream',        //$_FILES["myfile"]["type"][1]第二个上传文件的类型
                    2 => 'application/octet-stream'
                ),         //$_FILES["myfile"]["type"][2]第三个上传文件的类型
                'tmp_name' => Array(
                    0 => 'C:/WINDOWS/Temp/phpAF.tmp',
                    1 => 'C:/WINDOWS/Temp/phpB0.tmp',
                    2 => 'C:/WINDOWS/Temp/phpB1.tmp'
                ),
                'error' => Array(
                    0 => 0,
                    1 => 0,
                    2 => 0
                ),
                'size' => Array(
                    0 => 64,
                    1 => 1350,
                    2 => 66560
                )
            )
        );
        $arr = [];
        $e = array_keys($b['photo']);
        $num = count($b['photo'][$e[0]]);
        $a = $b['photo'];
        for ($i = 0; $i <= $num - 1; $i++) {
            foreach ($a as $k => $v) {
                $arr[$i][$k] = $v[$i];
            }


        }
        /*$a = $b['photo'];
        foreach ($a as $k=>$v){
            foreach ($v as $key =>$value){
                $arr[$key][$k] = $value;
            }
        }*/
        print_r($arr);


    }

}