<?php
class BadWords extends CApplicationComponent {

    public static function replacement($string){
        $sql = "select * from badword limit 100";
        $words = Yii::app()->db->createCommand($sql)->queryAll();
        $str = '';
        foreach((array)$words as $v){
            $str.=trim($v['words']).'|';
        }
        $str = str_replace('｜','|',$str);
        $str = str_replace('　','',$str);
        $str = preg_replace('/\s+/', '', $str);
        $str = substr($str,0,-1);
//        $filter = new Filter_String();
        $arr = explode('|',$str);
        $badArr = array();
        foreach($arr as $v){
            if($v){
                $badArr[] = $v;
            }
        }
        $badArr = array_combine($badArr,array_fill(0,count($badArr),'*'));
        return strtr($string, $badArr);
//        $filter->strings = $badArr;
//        $filter->text = $string;
//        $filter->replace_matches_inside_words = true;
//        return $filter->filter();
    }

}
