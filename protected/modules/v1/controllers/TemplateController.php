<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 2015/7/9
 * Time: 22:26
 */
class TemplateController extends ApiController{

    /**
     * 获取类型
     */
    public function actionGettype(){
        $this->sendDataResponse(TemplateType::model()->findAll(array(
            'order'=>'`order` ASC'
        )));
    }

    public function actionGet(){
        if(isset($_POST['id'])){
            $model = Template::model()->findByPk($_POST['id']);
            $this->sendDataResponse($model->getAttributes());
        }
    }

    /**
     * 获取列表
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
            $sql = "select * from template where rec_status='A' $where limit $start,$pageSize";
            $model = Yii::app()->db->createCommand($sql)->queryAll();
        }else{
            $sql = "select * from template where rec_status='A' $where";
            $model = Yii::app()->db->createCommand($sql)->queryAll();
        }
        $this->sendDataResponse($model);
    }

    public function actionDownload(){
        if(isset($_REQUEST['id'])){
            $model = Template::model()->findByPk($_REQUEST['id']);
            $dir_str = strstr($model->temp_url,'/uploads');
			$url = SITE_URL.$dir_str;
            $file_path = ROOT_PATH.$dir_str;
            if(is_file($file_path)){
//                 header("Pragma: public"); // required 指明响应可被任何缓存保存
//                 header("Expires: 0");
//                 header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//                 header("Cache-Control: private",false); // required for certain browsers
//                 header("Content-Type: application/zip");
//                 header('Content-Disposition: attachment; filename='.$model->temp_name);
//                 header("Content-Transfer-Encoding: binary");
//                 header('Content-Length: '.filesize($dir_str));
//                 ob_clean(); //Clean (erase) the output buffer
//                 flush(); //刷新PHP程序的缓冲，而不论PHP执行在何种情况下（CGI ，web服务器等等）。该函数将当前为止程序的所有输出发送到用户的浏览器。
//                 readfile( $dir_str ); //读入一个文件并写入到输出缓冲。
//                 Yii::app()->end();
				$file_name = ($model->temp_name);
            	$this->sendDataResponse(array('temp_name'=>$file_name, 'temp_url'=>$url));
            }else{
                $this->sendErrorResponse(404, $url);
            }
        }
    }


}