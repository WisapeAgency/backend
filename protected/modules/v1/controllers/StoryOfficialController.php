<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 2015/7/9
 * Time: 22:26
 */
class StoryOfficialController extends ApiController{

    public function actionDownload(){
    	$sql = "select * from story_official where rec_status='A' order by createtime desc limit 1";
    	$model = Yii::app()->db->createCommand($sql)->queryRow();
    	if($model){
            $dir_str = strstr($model['zip_url'],'/uploads');
			$url = SITE_URL.$dir_str;
            $file_path = ROOT_PATH.$dir_str;
            if(is_file($file_path)){
                header("Pragma: public"); // required 指明响应可被任何缓存保存
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private",false); // required for certain browsers
                header("Content-Type: application/zip");
                header('Content-Disposition: attachment; filename='.$model['name']);
                header("Content-Transfer-Encoding: binary");
                header('Content-Length: '.filesize($file_path));
                ob_clean(); //Clean (erase) the output buffer
                flush();
                readfile( $file_path ); //读入一个文件并写入到输出缓冲。
                Yii::app()->end();
            }else{
                $this->sendErrorResponse(404, $url);
            }
    	}else{
            $this->sendErrorResponse(404, '没有找到默认的story');
    	}
    }


}