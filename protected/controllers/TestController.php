<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 15-7-23
 * Time: 下午10:34
 */
class TestController extends Controller{

    public function actionIndex(){
        $str = 'http://www.wisape.com/uploads/2015072315/fb7261fad30c1b3f8ee42add8f5c68a9.zip';
        $dir_str = strstr($str,'/uploads');
        $dir_str = '/var/www/html/wis'.$dir_str;
        echo substr($dir_str,0,-4);exit;
        echo $dir_str;exit;
        $zip_dir = dirname($dir_str);
        echo $zip_dir;exit;
        $html_path = substr($dir_str,0,-4).'/stage.html';
        $str = str_replace('/var/www/html/wis','http://www.wisape.com',$html_path);
        $str = file_get_contents($str);
        echo $str;exit;
        echo $str = file_get_contents(str_replace('/var/www/html/wis','http://www.wisape.com',$html_path));
    }

    public function actionYs(){
        $zip = Yii::app()->zip;
        $dir = '/var/www/html/wis/uploads/2015072316/';
        $zip->makeZip($dir,".$dir.zip");
    }

}