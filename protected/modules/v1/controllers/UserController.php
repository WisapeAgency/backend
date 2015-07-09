<?php
class UserController extends ApiController
{
    public $layout='//layouts/column2';
    /**
     * @return array action filters
     */
//    public function filters()
//    {
//        return array(
//            'postOnly + create',
//            'putOnly + update',
//            'deleteOnly + delete'
//        );
//    }


    public function actionLogin()
    {
        //创建类型必须给出
        if(isset($_POST['type'])){
            $type=$_POST['type'];
        }else{
            $this->sendErrorResponse(403);
        }
        //本地注册处理
        if($type == WIS_USER){
            if(isset($_POST['user_email']) && isset($_POST['user_pwd'])){
                //邮箱是否已存在
                $rs = Yii::app()->db->createCommand()
                    ->select('user_id')
                    ->from('user')
                    ->where('user_email=:email',array(':email'=>strtolower($_POST['user_email'])))
                    ->queryScalar();
                if($rs){
                    $this->sendDataResponse(User::model()->findByPk($rs)->getAttributes());
                }
                try{
                    $model=new User;
                    $model->attributes=$_POST;
                    $model->user_email = strtolower($model->user_email);
                    $model->user_pwd = trim($_POST['user_pwd']);
                    //生成用户昵称
                    $nick_name = explode('@',$_POST['user_email']);
                    $model->nick_name = $nick_name[0];
//                    $model->nick_name = Yii::app()->badWords->replacement($model->nick_name);
                    $model->nick_name = $model->nick_name;
                    $model->user_ext = $type;
                    $model->access_token = $this->getAccessToken();
                    $model->save();
                    $this->sendDataResponse($model->getAttributes());
                }catch (Exception $e){
                    //本地用户创建失败!
                    $this->sendErrorResponse($e->getMessage());
                }
            }else{
                $this->sendErrorResponse(403,'用户输入信息不全');
            }
        }

        //第三方登陆是否已注册
        if($type<>WIS_USER && isset($_POST['unique_str']) && isset($_POST['user_ico']) && isset($_POST['nick_name'])  ){
            if($type == FACE_BOOK_USER){
                $user_ext_name = 'face_book';
            }elseif($type == TWITTER_USER){
                $user_ext_name = 'twitter';
            }
            //用户是否已存在
            $rs = Yii::app()->db->createCommand()
                ->select('user_id')
                ->from('user')
                ->where('user_ext=:user_ext',array(':user_ext'=>$_POST['type']))
                ->andWhere('unique_str=:unique_str',array(':unique_str'=>$_POST['unique_str']))
                ->queryScalar();
            if($rs){
                //用户已存在，无须创建!直接返回数据
                $model = User::model()->findByPk($rs);
                $this->sendDataResponse($model->getAttributes());
            }else{
                //如果系统不存在，则创建用户
                try{
                    $model=new User;
                    $model->attributes=$_POST;
                    //第三方拿到的信息有 id,名称，头象
                    $model->nick_name = $_POST['nick_name'];
//                    $model->nick_name = Yii::app()->badWords->replacement($model->nick_name);
                    $model->nick_name = $model->nick_name;
                    $model->user_ext = $_POST['type'];
                    $model->user_ext_name = $user_ext_name;
                    $model->user_ico_b = $_POST['user_ico'];
                    $model->unique_str = $_POST['unique_str'];
                    $model->access_token = $this->getAccessToken();
                    $model->save();
                }catch (Exception $e){
                    //第三方注册失败
                    $this->sendErrorResponse(500,$e->getMessage());
                }
                $this->sendDataResponse($model->getAttributes());
            }
        }else{
            $this->sendErrorResponse(403,'第三方登陆参数传递错误!');
        }
    }


    /**
     * 忘记密码处理
     * 用户填写email后，发送邮件到目标email后，用户点击链接后修改
     */
    public function actionForget(){
        if(isset($_POST['user_email'])){
            $email = strtolower(trim($_POST['user_email']));
            $userModel = User::model()->find('user_email=:user_email',array(':user_email'=>$email));
            if($userModel){
                //生成密钥
                $key = sha1(uniqid(rand()));
                $url = SITE_URL.'user/forget/uid/'.base64_encode($userModel->user_id).'/key/'.base64_encode($key).'/email/'.base64_encode($email);
                $html = <<<EOF
<table bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" style="border-spacing: 0px; text-align:center; font-family:'微软雅黑'; font-size:15px; line-height:32px;" width="100%">
	<tbody>
		<tr>
			<td style="height:30px; ">&nbsp;</td>
		</tr>
		<tr>
			<td align="center" bgcolor="#fff" style=" width: 620px;" valign="top">
			<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" style="color:#666;width: 620px;border-collapse: collapse; border:1px solid #d6d6d6;  padding:0 10px;text-align:left;font-size:14px; ">
				<tbody>
					<tr style="background: url(http://www.duorey.com/imges/bg_head.jpg) no-repeat; height:180px">
						<td style="text-align:left;border-collapse: collapse; padding:0 20px;">
						<h1 style="padding:15px 0;"><img src="http://www.duorey.com/imges/elogo.png" style="vertical-align: middle" /><br />
						<br />
						<span style="color:#333; font-weight:normal; font-size:22px;">Thank you for your support Duorey! </span></h1>
						</td>
					</tr>
					<tr>
						<td style=" border-collapse: collapse;padding:0 20px;">
						<p>Dear Customer,</p>

						<p>You requested to reset the password for your Duorey account. Please click this link to reset your password (valid for 10 minutes).</p>

						<div style="text-align:center;"><a href="{$url}" style=" font-size:20px; background:#4dcd70; border-radius:10px; width:200px;height:50px;color:#fff;line-height:50px; text-decoration:none; display:inline-block; text-align:center; border:none;">Reset passsword</a></div>
						</td>
					</tr>
            <tr >
                <td style=" border-collapse: collapse;padding:15px 20px;">
                        <p>
                         Please ignore this email in case you did not have password recovery request. If you still have other problems, please contact us: <a href="mailto:support@duorey.com">support@duorey.com</a><br /></p>
                     <p>Best Regards,<br/>Duorey Team</p>
                </td>
            </tr>
            <tr style="border-bottom:1px solid #d6d6d6; display:none; ">
                <td style=" border-collapse: collapse;padding:15px 20px;">
                       <p>
                <a href="#" target="_blank" style="color:#333; text-decoration:none;"><img src="http://www.duorey.com/imges/lock.png" style="vertical-align:text-bottom; margin-right:5px;" />Visist our website</a>
                <a href="#" target="_blank" style="padding:0 20px; color:#333; text-decoration:none;"><img src="http://www.duorey.com/imges/apple.png" style="vertical-align:text-bottom; margin-right:5px;"/>Download iOS app</a>
                <a href="#" target="_blank" style="color:#333; text-decoration:none;"><img src="http://www.duorey.com/imges/android.png" style="vertical-align:text-bottom; margin-right:5px;" />Download Android app</a>
                </p>
                </td>
            </tr>
            <tr  style="border-top:1px solid #d6d6d6; ">
                <td style="text-align:center; padding-top:10px;">
                <p>
                <a href="https://www.facebook.com/pages/Duorey/993002840725693" target="_blank" style="padding:0 20px;"><img src="http://www.duorey.com/imges/facebook.jpg" /></a>
                <a href="https://twitter.com/DuoRey"  target="_blank"><img src="http://www.duorey.com/imges/twitter.jpg" /></a>
                </p>
                    <p >This email was sent to {$email}.<br />
Don't want to receive this type of email? Unsubscribe.<br />
     Copyright © 2014. YiLe All rights reserved</p>
                </td>
            </tr>
				</tbody>
			</table>
			</td>
		</tr>
		<tr valign="bottom">
			<td style="border-collapse:collapse; height:10px;">&nbsp;</td>
		</tr>
	</tbody>
</table>
EOF;
                //发送邮件
                if($this->send_mail($_POST['user_email'],$html)){
                    //将密钥存入数据库并设置过期时间
                    $model = new UserForget();
                    $model->email = $email;
                    //二十分钟之内有效
                    $model->createtime = time()+60*60*10;
                    $model->user_id = $userModel->user_id;
                    $model->token = $key;
                    $model->rec_status = 'A';
                    if($model->save()){
                        $this->sendSucessResponse('邮件已发送,请查阅');
                    }else{
                        $this->log('User','Forget','邮件发送完成，数据库未记录');
                        $this->sendErrorResponse('邮件发送完成，数据库未记录');
                    }
                }else{
                    $this->log('User','Forget','邮件发送失败');
                    //邮件发送失败，报告错误
                    $this->sendErrorResponse('邮件发送失败');
                }
            }else{
                $this->log('User','Forget','用户不存在');
                $this->sendErrorResponse('用户不存在');
            }
        }
    }

    /**
     * 查看自已的资料
     * @uid
     * @token
     * 返回用户信息
     * 最近w一周播放
     */
    public function actionMyProfile(){
        if(isset($_POST['access_token'])){
            $model = $this->getUserModelByToken($_POST['access_token']);
            $this->sendDataResponse($model->getAttributes());
        }
    }

    /**
     * 用户修改个人资料
     * @uid
     * @token
     * @user_ico
     * @user_back_img
     * @user_sig
     */
    public function actionEditProfile(){
        if(isset($_POST['access_token'])){
            $userModel = $this->getUserModelByToken($_POST['access_token']);
//            $this->sendDataResponse($userModel->getAttributes());
//            $this->sendErrorResponse(404,$_POST['nick_name']);
            if(isset($_POST['nick_name'])){
                $userModel->nick_name = $_POST['nick_name'];
            }

            if(isset($_POST['user_ico'])){
                $img1 = $userModel->user_ico_b;
                $im1 = $userModel->user_ico_b = $this->saveStrToImg(trim($_POST['user_ico']));
                $userModel->user_ico_n = $im1;
            }
            if(isset($_POST['user_email'])){
                $userModel->user_email = $_POST['user_email'];
            }
            try{
                if($userModel->save()){
                    if($im1) $this->delFileFromServer($img1);
                }
            }catch (Exception $e){
                $this->sendErrorResponse(500,$e->getMessage());
            }
            $this->sendDataResponse($userModel->getAttributes());
        }
    }



}
