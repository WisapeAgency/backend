<?php

class StoryController extends ApiController{

    public function actionCreatezip(){
        $zip = Yii::app()->zip;
        if($zip->makeZip('./','./toto.zip')){
            echo 'ok';
        }else{
            echo 'false';
        }
        // make an ZIP archive
//        var_export($zip->infosZip('./toto.zip'), false); // get infos of this ZIP archive (without files content)
//        var_export($zip->infosZip('./toto.zip')); // get infos of this ZIP archive (with files content)
//        $zip->extractZip('./toto.zip', './1/'); //
    }

    /**
     * 解压并发布到指定目录后返回目录路径
     */
    public function actionExtract(){
        $zip = Yii::app()->zip;
        if($zip->extractZip('./toto.zip','./html')){
            echo 'ok';
        }else{
            echo 'false';
        }
    }




}