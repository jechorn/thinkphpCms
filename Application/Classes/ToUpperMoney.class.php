<?php
namespace Classes;

/** .-------------------------------------------------------------------
 * |    Software: []
 * | Description:
 * |        Site: www.jechorn.cn
 * |-------------------------------------------------------------------
 * |      Author: 王志传
 * |      Email : <jechorn@163.com>
 * |  CreateTime: 2016/12/20-23:06
 * | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 * '-------------------------------------------------------------------*/

/**
 * Class ToUpperMoney
 * @package Classes
 * @description 将金额改为中文大写数字
 */
class ToUpperMoney{
    protected $cnynums= array("零","壹","贰","叁","肆","伍","陆","柒","捌","玖");
    protected $cnyunits = array("圆","角","分");
    protected $cnygrees = array("拾","佰","仟","万","拾","佰","仟","亿");

    /**
     * @param $money 需要转换的小写金额
     * @return string 完成转换的大写金额
     */
    public function toUpperNumber($money){

        $price = $this->toChineseNumber($money);
        $dec   = $this->mb_str_split($price);
        return $this->toTrim($dec);

    }


    /**
     * @param $money
     * @return mixed
     */
    protected function toChineseNumber($money){
        if ($money>999999999999  ||$money< 0 ) return "金额数目不准确，请检查清楚";
        $money = round($money,2);
        list($int,$dec) = explode(".",$money,2);
        $dec = array_filter(array($dec[1],$dec[0]));
        $ret = array_merge($dec,array(implode("",$this->cnyMapUnit(str_split($int),$this->cnygrees)),""));
        $ret = implode("",array_reverse($this->cnyMapUnit($ret,$this->cnyunits)));
        return str_replace(array_keys($this->cnynums),$this->cnynums,$ret);
    }

    /**
     * @param $list
     * @param $units
     * @return array
     */
    protected function cnyMapUnit($list,$units) {
        $ul=count($units);
        $xs=array();
        foreach (array_reverse($list) as $x) {
            $l=count($xs);
            if ($x!="0" || !($l%4))
                $n=($x=='0'?'':$x).($units[($l-1)%$ul]);
            else $n=is_numeric($xs[0][0])?$x:'';
            array_unshift($xs,$n);
        }
        return $xs;
    }

    /**
     * @param $str 需要分割的中文字符串
     * @return array 返回分割好的数组；
     */
    protected function mb_str_split($str){
        return preg_split('/(?<!^)(?!$)/u', $str );
    }

    /**
     * @param $dec
     * @return string
     */
    protected function toTrim($dec){
        $num = count($dec);
        for ($i=0;$i<$num-2;$i++) {
            if ($dec[$i]=="零"&& $dec[$i+1]=="零") {
                array_splice($dec,$i,1);
            }
        }
        return implode("",$dec);

    }


}