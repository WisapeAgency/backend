<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AdminController extends CController
{
	protected $new_line = '<br/>';
	
    /**
     * @var string the default layout for the controller views. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout='//layouts/column1';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu=array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();

    public function init() {
        Yii::app()->theme='bootstrap';
        $this->attachBehavior('bootstrap', new BController($this));
    }
    
    /**
     * 删除目录
     * @param unknown $dir
     * @return boolean
     */
    protected function deldir($dir) {
    	//先删除目录下的文件：
    	$dh=opendir($dir);
    	while ($file=readdir($dh)) {
    		if($file!="." && $file!="..") {
    			$fullpath=$dir."/".$file;
    			if(!is_dir($fullpath)) {
    				unlink($fullpath);
    			} else {
    				$this->deldir($fullpath);
    			}
    		}
    	}
    
    	closedir($dh);
    	//删除当前文件夹：
    	if(rmdir($dir)) {
    		return true;
    	} else {
    		return false;
    	}
    }
    
    
    /**
     * 创建模板、字体、音乐时推送消息
     * @param unknown $messageModel
     */
    protected function sendMessage($messageModel){
    	$messageModel->parsetime=date('Y-m-d H:i:s', time() + 8 * 3600);//补充数据库字段的值，不会发送到parse
    	if($messageModel->save()){
	    	include ROOT_PATH.'/protected/extensions/Parse/ParseApi.php';
	    	$data = array (
	    			'type' => SYSTEM_MESSAGE,
	    			'id' => $messageModel->id,
	    			'message_title' => $messageModel->title,
	    			'message_subject' => $messageModel->subject
	    	);
	    	ParseApi::send($data);
    	}
    }
}