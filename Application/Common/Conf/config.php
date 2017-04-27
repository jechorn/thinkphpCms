<?php
return array(
	/*URL访问模式,可选参数0、1、2、3*/
    'URL_MODEL'             =>  1,
    'URL_HTML_SUFFIX'       => '',  // URL伪静态后缀设置
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'blog',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  '',    // 数据库表前缀
    'LOAD_EXT_CONFIG' => 'verify',
    'TMPL_PARSE_STRING'     =>array(
        '__UPLOAD__'    =>   __ROOT__.'/Uploads',
    ),



);