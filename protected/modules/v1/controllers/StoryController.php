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
	        	if($model->share_num == 10)
	        	{
                	$user = User::model()->findByPk($model->uid);
                	if($user && !empty($user->user_email)){
		        		$title = 'Your story has been shared more than 10 times';
		        		$user_message = 'We love your story "'.$model->story_name.'" and share it to our friends.\n Looking forward to read more stories from you.';
	        			$this->sendMessage($user->user_email, $title, $user_message);
	        		}
	        	}
	        }else if($type == 2){
	            $model->view_num +=1;
	        	if($model->view_num == 10)
	        	{
	        		$user = User::model()->findByPk($model->uid);
                	if($user && !empty($user->user_email)){
		        		$title = 'You win more than 10 audiences';
		        		$user_message = 'your story has been read more than 10 times.\n Publish it on your other social channels to get more audiences.'; 
	        			$this->sendMessage($user->user_email, $title, $user_message);
	        		}
	        	}
	        }else if($type == 3){
	        	$opt = isset($_REQUEST['opt']) ? $_REQUEST['opt'] : 'like';
	        	if($opt == 'like'){
		            $model->like_num +=1;
		        	if($model->like_num == 10)
		        	{
	                	$user = User::model()->findByPk($model->uid);
	                	if($user && !empty($user->user_email)){
			        		$title = 'Your story has been liked by more than 10 times.';
			        		$user_message = 'people liked your story "'.$model->story_name.'".\n Publish your story on other social channels to get more likes.';
			        		$this->sendMessage($user->user_email, $title, $user_message);
		        		}
		        	}
	        	}else{
	        		$model->like_num -=1;
	        	}
	        }
	        if($model->save()){
	            $this->sendDataResponse($model->getAttributes());
	        }
    	}else{
    		$this->sendErrorResponse(400, '缺少参数');
    	}
    }
    
    private function sendMessage($receiver, $title, $content){
    	$message=new SendMessage;
    	$message->user_email = $receiver;
    	$message->title = $title;
    	$message->user_message = $content;
    	if($message->save()){
	    	//推送
	    	include ROOT_PATH.'/protected/extensions/Parse/ParseApi.php';
	    	$data = array (
	    			'type' => SYSTEM_MESSAGE,
	    			'id' => $message->id,
	    			'message_title' => $message->title,
	    			'message_subject' => $message->subject
	    	);
	    	$param = array (
	    			'user' => $message->user_email
	    	);
	    	ParseApi::send($data, $param);
    	}
    }
    
    /**
     * 获取story的浏览、点赞、分享次数
     */
    public function actionShareNum() {
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
//         ini_set('max_input_time', 300);
//         ini_set('max_execution_time', 300);
        //if(!isset($_POST)) $this->sendErrorResponse(403);
        //修改哈
        if(isset($_REQUEST['sid'])){
            $model = Story::model()->findByPk($_REQUEST['sid']);
        }else{
            $model = new Story(); //新建
            $model->share_num = $model->view_num = $model->like_num = 0;
        }
        $model->createtime = time();
        $model->uid = $_REQUEST['uid'];
        $model->description = isset($_REQUEST['description'])?$_REQUEST['description']:'';
        $model->rec_status = isset($_REQUEST['rec_status'])?$_REQUEST['rec_status']:'';
        $model->small_img = isset($_REQUEST['small_img'])?$this->saveStoryCover(trim($_REQUEST['small_img'])):'';
        $model->story_name = $_REQUEST['story_name'];
        $model->bg_music = isset($_REQUEST['bg_music']) ? $_REQUEST['bg_music'] : '';
        if(isset($_FILES['zip_file']['tmp_name'])){
        	$filename = md5(uniqid());
            $target_path = ROOT_PATH.'/html/'.$_REQUEST['uid'].'/'.date('Ymd').'/'.$filename;
            if (!is_dir($target_path)){
            	$this->mkdirs($target_path);
            }
			//上传资源
            $zipPath = $target_path.'.zip';
        	if(!move_uploaded_file($_FILES['zip_file']['tmp_name'], $zipPath)){
        		$this->sendErrorResponse(500, '上传story资源失败');
        	}
        	//解压
            $zip = Yii::app()->zip;
            if($zip->extractZip($zipPath, $target_path)){
//                     if(!unlink($zipPath)) $this->sendErrorResponse(500,'del zip error');
				//TODO 替换图片为绝对路径，也可能在APP端做
                $prefix = $_REQUEST['img_prefix'];
                if(!empty($prefix)){
                	$prefix .= '/'.($model->story_name);
	                Yii::log('img_prefix:'.$prefix, CLogger::LEVEL_ERROR);
                	$url_prefix = str_replace(ROOT_PATH.'/', SITE_URL, $target_path);
                	$html_path = $target_path.'/story.html';
                	$content = file_get_contents($html_path);
                	Yii::log('replace_before:'.$content, CLogger::LEVEL_ERROR);
                	$content = str_replace($prefix, $url_prefix, $content);
                	Yii::log('replace_end:'.$content, CLogger::LEVEL_ERROR);
                	$fp=fopen($html_path,"w");
                	fwrite($fp,$content);
                	fclose($fp);
                	//
                	$model->story_url = $html_path;
                }
            }else{
                $this->sendErrorResponse(500,'zip file extract error');
            }
        }
        if($model->save()){
	        $this->sendDataResponse($model->getAttributes());
        }else{
            $this->sendErrorResponse(500, '保存story失败');
        }
    }
    
    /**
     * 设置story
     */
    public function actionSetting(){
    	if(!isset($_REQUEST['sid'])){
    		$this->sendErrorResponse('400', '缺少storyId');
    	}
    	$model = Story::model()->findByPk($_REQUEST['sid']);
    	//
    	if(isset($_REQUEST['story_name']) && !empty($_REQUEST['story_name'])){
    		$model->story_name = $_REQUEST['story_name'];
    	}
    	if(isset($_REQUEST['description']) && !empty($_REQUEST['description'])){
    		$model->description = $_REQUEST['description'];
    	}
    	if(isset($_REQUEST['small_img']) && !empty($_REQUEST['small_img'])){
    		$model->small_img = $this->saveStoryCover(trim($_REQUEST['small_img']));
    	}
    	
    	if($model->save()){
	        $this->sendDataResponse($model->getAttributes());
        }else{
            $this->sendErrorResponse(500, '设置story失败');
        }
    }

    /**
     * delete story
     * sid
     */
    public function actionDel(){
        $model = $this->getUserModelByToken($_REQUEST['access_token']);
        if($model){
	        $uid = $model->user_id;
	
	        $model = Story::model()->findByAttributes(array(
	            'id'=>$_REQUEST['sid'],
	            'uid'=>$uid
	        ));
	        if($model){
	            $model->rec_status='D';
	            if($model->save()){
	            	$this->sendDataResponse($model->getAttributes());
	            }else{
		        	$this->sendErrorResponse('500', '删除失败');
	            }
	        }else{
	        	$this->sendErrorResponse('404', '没有对应的story');
	        }
        }else{
        	$this->sendErrorResponse('404', '用户token验证失败');
        }
    }

    /**
     * story List
     */
    public function actionList(){
        $model = $this->getUserModelByToken($_REQUEST['access_token']);
        if($model){
	        $uid = $model->user_id;
            if(isset($_REQUEST['page'])){
                $page = $_REQUEST['page'];
                if(isset($_REQUEST['page_size'])){
                    $pageSize = $_REQUEST['page_size'];
                }else{
                    $pageSize = PAGE_SIZE;
                }
                $start = ($page-1)*$pageSize;
                $sql = "SELECT * FROM story WHERE uid=$uid AND rec_status='A' limit $start,$pageSize";
                $model = Yii::app()->db->createCommand($sql)->queryAll();
            }else{
                $model = Story::model()->findAll("uid=:uid AND rec_status='A'",array(
                    ':uid'=>$uid,
                ));
            }
            $this->sendDataResponse($model);
        }else{
        	$this->sendErrorResponse(404, '无效的token');
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


    public function actionDefault(){
    	$sql = "select * from story_official where rec_status='A' order by createtime desc limit 1";
    	$model = Yii::app()->db->createCommand($sql)->queryRow();
    	if($model){
//     		$dir_str = strstr($model['zip_url'],'/uploads');
//     		$url = SITE_URL.$dir_str;
//     		$file_path = ROOT_PATH.$dir_str;
//     		if(is_file($file_path)){
//     			header("Pragma: public"); // required 指明响应可被任何缓存保存
//     			header("Expires: 0");
//     			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//     			header("Cache-Control: private",false); // required for certain browsers
//     			header("Content-Type: application/zip");
//     			header('Content-Disposition: attachment; filename='.$model['name']);
//     			header("Content-Transfer-Encoding: binary");
//     			header('Content-Length: '.filesize($file_path));
//     			ob_clean(); //Clean (erase) the output buffer
//     			flush();
//     			readfile( $file_path ); //读入一个文件并写入到输出缓冲。
//     			Yii::app()->end();
//     		}else{
//     			$this->sendErrorResponse(404, $url);
//     		}
			$this->sendDataResponse($model);
    	}else{
    		$this->sendErrorResponse(404, '没有找到默认的story');
    	}
    }




}