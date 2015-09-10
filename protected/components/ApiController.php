<?php
/**
 * Api控制器的基类
 * Class ApiController
 */
class ApiController extends CController
{
    public function init(){
        if(YII_DEBUG === false){
            if($this->auth() === false){
                $this->sendErrorResponse(401);
                Yii::app()->end();
            }
        }
    }
    /**
     * 获取某个header值
     * @param $headerName
     * @return null
     */
    protected function getHeader($headerName){
        foreach (getallheaders() as $name => $value) {
            if($headerName == $name){
                return $value;
            }
        }
        return null;
    }

    /**
     * 返回Linkuser用户信息
     * @param $link_type
     * @param $unique_sign
     * @return array|CActiveRecord|mixed|null
     */
    protected function getLinkUserModel($link_type,$unique_sign){
        return CalUser::model()->findByAttributes(array(
            'link_type'=>$link_type,
            'unique_sign'=>$unique_sign
        ));
    }

    /**
     * 根据token返回用户模型
     * @param $user_token
     * @return array|CActiveRecord|mixed|null
     */
    protected function getUserModelByToken($access_token){
        return User::model()->findByAttributes(array(
            'access_token'=>$access_token,
        ));
    }
    
    /**
     * 根据用户email返回用户模型
     * @param unknown $email
     */
    protected function getUserModelByEmail($email){
		$rs = Yii::app ()->db->createCommand ()->select ( 'user_id' )->from ( 'user' )->where ( 'user_email=:email', array (
				':email' => strtolower ( $email ) 
		) )->queryScalar ();
		if ($rs) {
			return User::model ()->findByPk ( $rs )->getAttributes ();
		}
		return false;
	}

    /**
     * 服务端生成与客户端一样的token值
     * @return string
     */
    protected function generateToken(){
        $str = '';
        $expires = 0;
        ksort($_POST);
        foreach((array)$_POST as $k=>$v){
            $str.=$k.'='.$v.'&';
            if($k='expires'){
                $expires = $v;
            }
        }
        if(strlen($str)<=0){
            $this->sendErrorResponse(403);
        }
        $str = substr($str,0,-1);
        $str.=KEY;
        return array(
            'md5'=>md5($str),
            'expires'=>$expires
        );
    }

    /**
     * 产生128位token
     * 每个用户不会改变，作为识别用户身份
     * @return string
     */
    protected function createToken(){
//        return bin2hex(mcrypt_create_iv(64, MCRYPT_DEV_RANDOM));
        return md5(uniqid().time());
    }

    protected function getToken(){
        //当是旧的token值时,需要传递token值过来
        //获取http头信息
        $token = $this->getHeader('token');
        if($token){
            $model = CalUser::model()->findAllByAttributes(array('user_token'=>$token));
            if($model){
                $model->user_token = $this->generateToken();
                $model->user_token_expires = time()+TOKEN_EXPIRES;
                $model->save();
                return $model->user_token;
            }
        }
        return null;
    }

    /**
     * 成功并返回数据
     * @param $data
     * @param string $message
     */
    protected function sendDataResponse(array $data,$message='')
    {
        header('Content-type: application/json', true, 200);
        echo CJSON::encode(array(
            'success' => 1,
            'data' => $data,
            'message' => $message
        ));
        Yii::app()->end();
    }

    /**
     * 返回成功，但并不返回数据
     */
    protected function sendSuccessResponse(){
        header('Content-type: application/json', true, 200);
        echo CJSON::encode(array(
            'success' => 1,
        ));
        Yii::app()->end();
    }

    /**
     * 发送错误消息
     * 400 参数不正确，服务器无法理解
     * 401 当前请求需要用户验证
     * 403 禁止访问
     * 500 服务器错误
     * 404 资源不存在
     *
     * @param $message
     * @param array $data
     */
    protected function sendErrorResponse($code,$message='',$data = array())
    {
        header('Content-type: application/json', true, 200);
        echo CJSON::encode(
            array(
                'success' => $code,
                'message' => $message,
                'data' => $data
            )
        );
        Yii::app()->end();
    }


    /**
     * 确认权限并返回请求过期时间
     * 如请请求的链接为2分钟内，则有效
     * 超时返回false
     * @return bool
     */
    protected function auth(){
        $md5_data = $this->generateToken($_POST);
        if($this->getHeader('token') != $md5_data['md5'] || (time()-$md5_data['expires'])<TOKEN_EXPIRES ){
            return false;
            Yii::app()->end();
        }
        return true;
    }


    protected function saveStrToImg($str){
        $jpg = base64_decode($str);
        $filename=time().'_'.rand().'.jpg';

        $dir = '/uploads/avatar/'.date('Ymd').'/';
        $path = ROOT_PATH.$dir;
        try{
            if (!is_dir($path)) $this->mkdirs($path);
            //打开文件准备写入
            $file = fopen($path.$filename,"w");
            fwrite($file,$jpg);//写入
            fclose($file);//关闭
            return SITE_URL.$dir.$filename;
        }catch (Exception $e){
            $this->sendErrorResponse(500,'图片保存失败!');
        }
    }

    /**
     * 递归创建目录
     * @param  $dir
     */
    protected function mkdirs($dir){
        if(!is_dir($dir)){
            $this->mkdirs(dirname($dir));
            mkdir($dir);
        }
    }

    /**
     * 删除指定的文件
     * @param $url
     * @return bool
     */
    protected function delFileFromServer($url){
        $tmp = stripos($url, '/uploads');
        $path = substr($url,$tmp);
        $filename = $path;
        if(file_exists($filename)){
            if(unlink($filename)){
                return true;
            }else{
                return false;
            }
        }
    }


    /**
     * 检查当前用户的user_token
     * @param CalUser $model
     * @param $user_token
     * @return bool
     */
    protected function checkUserToken(CalUser $model,$user_token){
        if($model->user_token == $user_token){
            return true;
        }else{
            $this->sendErrorResponse(403);
        }
    }



    protected function getAccessToken(){
        return md5(sha1(uniqid(rand())).microtime());
    }

    protected function sendemail($email,$html){
        $to = $email;
        $subject = 'Password Recovery';
        if($to !== null){
//             //要看email是否存在，存在才发邮件
//             $data = $this->curl_post("http://107.150.97.118:58080/web/check!email.action", array(
//                 'email'=>$to
//             ));
//             $resultData = json_decode($data);
//             if($resultData->errorCode == 3){
                $key = sha1(uniqid(rand()));
                $url = SITE_URL.'site/forget/k/'.base64_encode($key).'/e/'.base64_encode($to);
//                 try{
//                     $model = new WebForget();
//                     $model->forget_key = $key;
//                     $model->user_email = $to;
//                     $model->rec_status = 'A';
//                     $model->save();
//                 }catch (Exception $e){
//                     echo $e->getMessage();exit;
//                 }

//                 $html = <<<EOF
//                 Hello!,

//                 You recently requested a new password for your account. Click the following link to create a new password.
//                 {$url}
//                 If clicking the link above doesn't work, please copy and paste the link in a new browser window instead.
//                      Please note: your secure link is only valid for a limited period of time.
//                 If you have not requested a new password it's likely that another user entered your address by mistake, so you can safely disregard this email.

//                 Welcome back!
//                 wisape.com
// EOF;
                
                Yii::app()->mailer->Host = 'smtp.exmail.qq.com';
                Yii::app()->mailer->IsSMTP();
                Yii::app()->mailer->IsHTML(true);
                Yii::app()->mailer->From = 'support@wisape.com';
                Yii::app()->mailer->FromName = 'wisape';
                Yii::app()->mailer->Username = 'support@wisape.com';
                Yii::app()->mailer->Password = '20150625wisape';
                Yii::app()->mailer->SMTPSecure = 'ssl';
                Yii::app()->mailer->Port = 465;
                Yii::app()->mailer->SMTPAuth  = true;
                Yii::app()->mailer->SMTPDebug = false;
                Yii::app()->mailer->AddReplyTo('support@wisape.com');
                Yii::app()->mailer->AddAddress($to);
                Yii::app()->mailer->Subject = $subject;
                Yii::app()->mailer->Body = $html;
                if(!Yii::app()->mailer->Send()){
//                     Yii::app()->end();
                    return false;
                }else{
//                     Yii::app()->end();
                    return true;
                }
//             }else{
//                 echo 2;Yii::app()->end();
//             }
        }
        return false;
    }


}