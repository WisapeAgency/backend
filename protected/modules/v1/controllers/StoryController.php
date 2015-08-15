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
     * 前端调用
     */
    public function actionShare(){
    	if(isset($_REQUEST['type']) && isset($_REQUEST['sid'])){
	        $type = $_REQUEST['type'];
	        $model = Story::model()->findByPk($_REQUEST['sid']);
	        if($type == 1){
	            $model->share_num +=1;
	        }else if($type == 2){
	            $model->view_num +=1;
	        }else if($type == 3){
	            $model->like_num +=1;
	        }
	        if($model->save()){
	            $this->sendDataResponse($model->getAttributes());
	        }
    	}else{
    		$this->sendErrorResponse(400, '缺少参数');
    	}
    }
    
    /**
     * 获取story的浏览、点赞、分享次数
     */
    public function actionGetShare() {
    	if(isset($_REQUEST['sid'])){
    		$model = Story::model()->findByPk($_REQUEST['sid']);
    		$data = array('view_num'=>$model->view_num, 'like_num'=>$model->like_num, 'share_num'=>$model->share_num);
    		$this->sendDataResponse($data);
    	}else{
    		$this->sendErrorResponse(400, '缺少参数');
    	}
    }


    /**
     * 创建，修改故事
     */
    public function actionCreate(){
        ini_set('upload_max_filesize', '20M');
        ini_set('post_max_size', '20M');
        ini_set('max_input_time', 300);
        ini_set('max_execution_time', 300);
        //if(!isset($_POST)) $this->sendErrorResponse(403);
        //修改哈
        if(isset($_POST['sid'])){
            $model = Story::model()->findByPk($_POST['sid']);
        }else{
            $model = new Story(); //新建
            $model->share_num = $model->view_num = $model->like_num = 0;
        }
        $model->createtime = time();
        $model->uid = $_POST['uid'];
        $model->description = isset($_POST['description'])?$_POST['description']:'';
        $model->rec_status = isset($_POST['rec_status'])?$_POST['rec_status']:'';
        $model->small_img = isset($_POST['small_img'])?$this->saveStrToImg(trim($_POST['small_img'])):'';
        $model->story_name = $_POST['story_name'];
        if(isset($_FILES['zip_file']['tmp_name'])){
            $target_path = "html/";
            $target_path = $target_path.$_POST['uid'].'/'.date('YmdHi');
            $zipPath = $target_path.'/'.$_FILES['zip_file']['name'];
            if (!is_dir($target_path)) $this->mkdirs($target_path);
//                $this->sendErrorResponse(404,$target_path);
            try {
                if (!move_uploaded_file($_FILES['zip_file']['tmp_name'],$zipPath)){
                    $this->sendErrorResponse(403);
                }
                $zip = Yii::app()->zip;
                if($zip->extractZip($zipPath,$target_path)){
                    if(!unlink($zipPath)) $this->sendErrorResponse(500,'del zip error');
                    $model->story_url = SITE_URL.'/'.$target_path;
                    $fp=fopen("/var/www/html/wis/$target_path","r+");
                    while(!feof($fp))
                    {
                        $buffer=fgets($fp,4096);
//                        $story .=$this->replace_tag($buffer);
                    }
                }else{
                    $this->sendErrorResponse(500,'zip file extract error');
                }
            } catch (Exception $e) {
                $this->sendErrorResponse(403,$e->getMessage());
            }
        }
        if(!$model->save()){
            $this->sendErrorResponse(403);
        }
        $this->sendDataResponse($model->getAttributes());
    }

    /**
     * delete story
     * sid
     */
    public function actionDel(){
        $model = $this->getUserModelByToken($_POST['access_token']);
        $uid = $model->user_id;

        $model = Story::model()->findByAttributes(array(
            'id'=>$_POST['sid'],
            'uid'=>$uid
        ));
        if($model){
            $model->rec_status='D';
            if($model->save()) $this->sendDataResponse($model->getAttributes());
        }
    }

    /**
     * story List
     */
    public function actionList(){
        $model = $this->getUserModelByToken($_POST['access_token']);
        $uid = $model->user_id;
        if($model){
            if(isset($_POST['page'])){
                $page = $_POST['page'];
                if(isset($_POST['page_size'])){
                    $pageSize = $_POST['page_size'];
                }else{
                    $pageSize = PAGE_SIZE;
                }
                $start = ($page-1)*$pageSize;
                $sql = "select * from story where uid=$uid limit $start,$pageSize";
                $model = Yii::app()->db->createCommand($sql)->queryAll();
            }else{
                $model = Story::model()->findAll('uid=:uid',array(
                    ':uid'=>$uid,
                ));
            }
            $this->sendDataResponse($model);
        }

    }

    /**
     * story user List
     */
    public function actionUserList(){
        $model = $this->getUserModelByToken($_POST['access_token']);
        if($model){
            $uid = $model->user_id;
            //获取用户story list
            $sql = "select * from story where uid=$uid and rec_status='A'";
            $models = Story::model()->findAllBySql($sql);
            $this->sendDataResponse($models);
        }
        $this->sendErrorResponse(403);
    }

    /**
     * 获取某个template的zip包
     */
    public function actionTemplate(){
        if(isset($_POST['uid'])){
            $model = Story::model()->findByPk($_POST['sid']);
            if(empty($model->story_url)){
//                $dir = substr($model->story_url,0,);
            }
        }
    }

    /**
     * copy story
     * uid 当前用户
     */
    public function actionCopystory(){
        if(isset($_POST['sid']) && $_POST['uid']){
            $sourceStory = Story::model()->findByPk($_POST['sid']);
            if($sourceStory->uid != 1) $this->sendErrorResponse(403,'不是官方提供的模板');
            $model = new Story();
            $model->attributes = $sourceStory->getAttributes();
            $model->uid = $_POST['uid'];
            if($model->save()){
                $this->sendDataResponse($model->getAttributes());
            }
        }
    }


    /**
     * get Story by sid
     */
    public function actionGet(){
        if(isset($_POST['sid'])){
            $model = Story::model()->findByPk($_POST['sid']);
            $this->sendDataResponse($model->getAttributes());
        }
        $this->sendErrorResponse(403);
    }

    /**
     *
     */
    public function actionContent(){
        if(isset($_POST['sid'])){
            $model = Story::model()->findByPk($_POST['sid']);
            echo file_get_contents($model->story_url.'/story.html');
        }
    }







}