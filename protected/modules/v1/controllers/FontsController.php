<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 15-7-19
 * Time: 下午2:12
 */
class FontsController extends ApiController
{
    public function actionList(){
        if(isset($_POST['page'])){
            $page = $_POST['page'];
            if(isset($_POST['page_size'])){
                $pageSize = $_POST['page_size'];
            }else{
                $pageSize = PAGE_SIZE;
            }
            $start = ($page-1)*$pageSize;
            $sql = "select * from fonts limit $start,$pageSize";
            $model = Yii::app()->db->createCommand($sql)->queryAll();
        }else{
            $sql = "select * from fonts";
            $model = Yii::app()->db->createCommand($sql)->queryAll();
        }
        $this->sendDataResponse($model);
    }

    public function actionGet(){
        if(isset($_POST['id'])){
            $model = Fonts::model()->findByPk($_POST['id']);
            $model->dir_url = substr($model->zip_url,0,-4);
            $model->save();
            $this->sendDataResponse(array_merge($model->getAttributes(),array('dir_url'=>$model->dir_url)));
        }
    }

    public function actionDownload(){
        if(isset($_POST['id'])){
            $model = Fonts::model()->findByPk($_POST['id']);
            $dir_str = strstr($model->zip_url,'/uploads');
			$url = SITE_URL.$dir_str;
            $file_path = ROOT_PATH.$dir_str;
            if(is_file($file_path)){
                header("Pragma: public"); // required 指明响应可被任何缓存保存
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private",false); // required for certain browsers
                header("Content-Type: application/zip");
                header('Content-Disposition: attachment; filename='.$model->name);
                header("Content-Transfer-Encoding: binary");
                header('Content-Length: '.filesize($dir_str));
                ob_clean(); //Clean (erase) the output buffer
                flush();
                readfile( $file_path ); //读入一个文件并写入到输出缓冲。
                Yii::app()->end();
            }else{
                $this->sendErrorResponse(404, $url);
            }
        }
    }
    
    public function actionDLbyName(){
    	if(isset($_REQUEST['name'])){
    		$sql = "select * from fonts where name='".$_REQUEST['name']."' limit 1";
    		$model = Yii::app()->db->createCommand($sql)->queryRow();
    		$dir_str = strstr($model['zip_url'],'/uploads');
    		$temp_url = SITE_URL.$dir_str;
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
    			$this->sendErrorResponse(404, $temp_url);
    		}
    	}
    }
}