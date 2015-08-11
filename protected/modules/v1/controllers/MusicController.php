<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 15-7-11
 * Time: 下午7:12
 */
class MusicController extends ApiController{


    /**
     * 获取音乐类型
     */
    public function actionGettype(){
        $this->sendDataResponse(MusicType::model()->findAll(array(
            'order'=>'`order` ASC'
            )));
    }

    /**
     * 获取音乐列表
     */
    public function actionList(){
        $where = '';
        if(isset($_POST['type'])){
            $where = " AND type={$_POST['type']}";
        }
        if(isset($_POST['page'])){
            $page = $_POST['page'];
            if(isset($_POST['page_size'])){
                $pageSize = $_POST['page_size'];
            }else{
                $pageSize = PAGE_SIZE;
            }
            $start = ($page-1)*$pageSize;
            $sql = "select * from music where rec_status='A' $where limit $start,$pageSize";
            $model = Yii::app()->db->createCommand($sql)->queryAll();
        }else{
            $sql = "select * from music where rec_status='A' $where";
            $model = Yii::app()->db->createCommand($sql)->queryAll();
        }
        $this->sendDataResponse($model);
    }

    public function actionDownload(){
        if(isset($_POST['id'])){
            $model = Music::model()->findByPk($_POST['id']);
            $dir_str = strstr($model->music_url,'/uploads');
            $dir_str = '/var/www/html/wis'.$dir_str;
            if(is_file($dir_str)){
                header("Pragma: public"); // required 指明响应可被任何缓存保存
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private",false); // required for certain browsers
                header("Content-Type: application/zip");
                header('Content-Disposition: attachment; filename='.$model->music_name);
                header("Content-Transfer-Encoding: binary");
                header('Content-Length: '.filesize($dir_str));
                ob_clean(); //Clean (erase) the output buffer
                flush();
                readfile( $dir_str ); //读入一个文件并写入到输出缓冲。
                Yii::app()->end();
            }else{
                $this->sendErrorResponse(404,$model->music_url);
            }
        }
    }
}