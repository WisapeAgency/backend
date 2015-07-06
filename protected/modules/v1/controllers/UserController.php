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
     * 本地用户登陆 登陆后更新token
     * @user_email
     * @user_pwd
     */
//    public function actionLogin(){
//        if(isset($_POST['access_token'])){
//            $rs = Yii::app()->db->createCommand()
//                ->select('user_id')
//                ->from('user')
//                ->where('user_email=:user_email',array(':user_email'=>strtolower(trim($_POST['user_email']))))
//                ->andWhere('user_pwd=:user_pwd',array(':user_pwd'=>trim($_POST['user_pwd'])))
//                ->queryScalar();
//            if($rs){
//                $user = User::model()->findByPk($rs);
//                //每次登陆后就更新access_token
//                $user->access_token = $this->getAccessToken();
//                $user->save();
//                $this->sendDataResponse($user->getAttributes());
//            }else{
//                $this->log('User','Login','登陆帐号或密码错误');
//                $this->sendErrorResponse(404,'登陆帐号或密码错误');
//            }
//        }else{
//            $this->sendErrorResponse(403,'本地用户登陆input输入参数不全');
//        }
//    }


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
        if(isset($_POST['uid']) && isset($_POST['token'])){
            $this->auth($_POST['uid'],$_POST['token']);
            $model = User::model()->findByPk($_POST['uid']);
            $data['user'] = $model->getResponseData();
            $data['recent'] = $this->UserRecentPlay($_POST['uid']);
            $data['recent_week'] = $this->UserRecentPlay($_POST['uid'],'w');
            $this->sendDataResponse($data);
        }
    }

    /**
     * 查看某用户的资料
     * @uid
     * @token
     * @target_uid
     */
    public function actionProfile(){
        if(isset($_POST['uid']) && isset($_POST['token']) && isset($_POST['target_uid'])){
            $this->auth($_POST['uid'],$_POST['token']);
            $model = User::model()->findByPk($_POST['target_uid']);
            $data =  array();
            $data['user'] = $model->getResponseData();
            //用户是否关注这个用户
            $data['isflow'] = $this->isFlow($_POST['uid'],$_POST['target_uid']);
            $data['feed_playlist'] = $this->recentUserFeedList($_POST['target_uid'],0,5);
            $data['feed_num'] = $this->recentFeedListNum($_POST['target_uid']);
            $this->sendDataResponse($data);
        }
    }

    /**
     * 查看用户关注的歌单
     */
    public function actionGetUserFlowList(){
        if(isset($_POST['uid']) && isset($_POST['token']) && isset($_POST['target_uid']) && isset($_POST['page'])){
            $this->auth($_POST['uid'],$_POST['token']);
            $pageSize = 10;
            $start = ($_POST['page']-1)*$pageSize;
            $data = $this->recentUserFeedList($_POST['target_uid'],$start,$pageSize);
            $this->sendDataResponse($data);
        }
    }

    /**
     * 某用户是否已关注某用户
     */
    private function isFlow($uid,$target_uid){
        $model = UserFlow::model()->findAll('uid=:uid and fid=:fid',array(
            ':uid'=>$uid,
            ':fid'=>$target_uid
        ));
        if($model){
            return 1;
        }
        return 0;
    }

    /**
     * 我最近播放的歌曲
     */
    public function actionMyRecent(){
        if(isset($_POST['uid']) && isset($_POST['token']) ){
            $this->auth($_POST['uid'],$_POST['token']);
            $this->sendDataResponse($this->UserRecentPlay($_POST['uid']));
        }
    }

    /**
     * 获取某用户最的播放的歌曲
     */
    private function UserRecentPlay($uid,$type='',$limit=30){
        if($type == 'w'){
            //本周开始时间
            $day = date('w');
            $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
            $time = strtotime($week_start);
            $sql = "SELECT b.sid FROM user_action AS a
                    inner JOIN music_source AS b ON(a.sid=b.sid)
                    WHERE a.`action`=1 AND a.uid=$uid
                    AND a.createtime>={$time}
                    AND a.sid IS NOT NULL GROUP BY a.sid ORDER BY count(*) DESC limit {$limit}";
//            $criteria  = new CDbCriteria();
//            $criteria->select='*';
//            $criteria->join='LEFT JOIN user_action AS b ON(t.sid=b.sid)';
//            $criteria->addCondition('b.`action`=1 AND b.uid='.$uid.'');
//            $criteria->addCondition('b.createtime>='.$time.'');
//            $criteria->addCondition('b.sid is not null');
//            $criteria->group = 'b.sid';
//            $criteria->order = 'b.createtime DESC';
//            $criteria->limit = $limit;
//            $rs = MusicSource::model()->findAll($criteria);
//            return $rs[0]->attributes;
        }else{
            $sql = "SELECT b.sid FROM user_action AS a
                    inner JOIN music_source AS b ON(a.sid=b.sid)
                    WHERE a.`action`=1 AND a.uid=$uid
                    AND a.sid IS NOT NULL GROUP BY a.sid ORDER BY a.createtime DESC limit $limit";
        }
        $ids = Yii::app()->db->createCommand($sql)->queryAll();
        $data = $this->getMusicSourceByIds($ids);
        return $data;
    }




    /**
     * 用户关注的歌单数量
     * @param $uid
     * @return mixed
     */
    private function recentFeedListNum($uid){
        $sql = "SELECT COUNT(*) FROM list_flow WHERE uid=$uid";
        return Yii::app()->db->createCommand($sql)->queryScalar();
    }
    /**
     * 关注某用户
     * @uid
     * @token
     * @target_uid
     */
    public function actionFlowUser(){
        if(isset($_POST['uid']) && isset($_POST['token']) && isset($_POST['target_uid']) && isset($_POST['act'])){
            $this->auth($_POST['uid'],$_POST['token']);
            if($_POST['act'] == 'add'){
                //如果之前曾经关注过，则只需要再次开启关注即可
                $model = UserFlow::model()->find('uid=:uid and fid=:fid',array(
                    ':uid'=>$_POST['uid'],
                    ':fid'=>$_POST['target_uid']
                ));
                if($model){
                    $this->sendSucessResponse('关注成功');
                }else{
                    $transaction = Yii::app()->db->beginTransaction();
                    try{
                        //之前未关注过，需要关注一下
                        $model = new UserFlow();
                        $model->uid = $_POST['uid'];
                        $model->fid = $_POST['target_uid'];
                        $model->save();

                        //目标用户表中关注+1
                        $userModel = User::model()->findByPk($_POST['target_uid']);
                        $userModel->user_flowed +=1;
                        $userModel->save();

                        //我的关注人数+1
                        $myUserModel = User::model()->findByPk($_POST['uid']);
                        $myUserModel->user_flow +=1;
                        $myUserModel->save();

                        //同时写入动态之中
                        $actionModel = new UserAction();
                        $actionModel->action = $this->userAction['flow_user'];
                        $actionModel->uid = $_POST['uid'];
                        $actionModel->tid = $_POST['target_uid'];
                        $actionModel->createtime = time();
                        $actionModel->save();
                        $transaction->commit();
                        $this->sendDataResponse($userModel->getResponseData());
                    }catch (Exception $e){
                        $transaction->rollBack();
                        $this->log('User','FlowUser','关注失败'.$e->getMessage());
                        $this->sendErrorResponse($e->getMessage());
                    }
                }
            }else if($_POST['act'] == 'del'){
                $transaction = Yii::app()->db->beginTransaction();
                try{
                    //取消关注
                    UserFlow::model()->deleteAll('uid=:uid and fid=:fid',array(
                        ':uid'=>$_POST['uid'],
                        ':fid'=>$_POST['target_uid']
                    ));
                    //目标用户表中关注-1
                    $userModel = User::model()->findByPk($_POST['target_uid']);
                    if($userModel->user_flowed>0) $userModel->user_flowed -=1;
                    $userModel->save();

                    //我的关注人数-1
                    $myUserModel = User::model()->findByPk($_POST['uid']);
                    if($myUserModel->user_flow>0) $myUserModel->user_flow -=1;
                    $myUserModel->save();
                    $transaction->commit();
                    $this->sendDataResponse($userModel->getResponseData());
                }catch (Exception $e){
                    $transaction->rollBack();
                    $this->log('User','FlowUser','取消关注失败'.$e->getMessage());
                    $this->sendErrorResponse($e->getMessage());
                }
            }
        }
    }

    /**
     * 我赞了某歌单
     */
    public function actionDing(){
        if(isset($_POST['uid']) && isset($_POST['token']) && isset($_POST['lid']) && isset($_POST['act'])){
            $this->auth($_POST['uid'],$_POST['token']);
            $transaction = Yii::app()->db->beginTransaction();
            if($_POST['act'] == 'del'){
                try{
                    UserDing::model()->deleteAll('uid=:uid and lid=:lid',array(
                        ':uid'=>$_POST['uid'],
                        ':lid'=>$_POST['lid']
                    ));
                    //目标用户表中关注+1
                    $listModel = MusicList::model()->findByPk($_POST['lid']);
                    if($listModel->ding_num>0) $listModel->ding_num -=1;
                    $listModel->save();
                    $transaction->commit();
                    $this->sendDataResponse($listModel->getResponseData(),'取消赞成功');
                }catch (Exception $e){
                    $transaction->rollBack();
                    $this->log('User','Ding','取消赞失败'.$e->getMessage());
                    $this->sendErrorResponse('取消赞失败');
                }
            } else if($_POST['act'] == 'add'){
                try{
                    $model = UserDing::model()->find('uid=:uid and lid=:lid',array(
                        ':uid'=>$_POST['uid'],
                        ':lid'=>$_POST['lid']
                    ));
                    if($model){
                        $this->sendSucessResponse('已赞过');
                    }
                    $model = new UserDing();
                    $model->lid = $_POST['lid'];
                    $model->uid = $_POST['uid'];
                    $model->save();

                    //目标用户表中关注-1
                    $listModel = MusicList::model()->findByPk($_POST['lid']);
                    $listModel->ding_num +=1;
                    $listModel->save();

                    $modelAction = new UserAction();
                    $modelAction->lid = $_POST['lid'];
                    $modelAction->uid = $_POST['uid'];
                    $modelAction->action = $this->userAction['ding'];
                    $modelAction->createtime = time();
                    $modelAction->save();
                    $transaction->commit();
                    $this->sendDataResponse($listModel->getResponseData());
                }catch (Exception $e){
                    $transaction->rollBack();
                    $this->log('User','Ding','点赞失败'.$e->getMessage());
                    $this->sendErrorResponse($e->getMessage());
                }
            }
        }
    }
    /**
     * 显示用户的动态
     * 包括歌单的动态
     * @uid
     * @token
     * @page
     */
    public function actionUserActive(){
        if(isset($_POST['uid']) && isset($_POST['token']) && isset($_POST['page'])){
            $this->auth($_POST['uid'],$_POST['token']);
            $userString='';
            $playList ='';
            //人的动态
            $sql = "SELECT fid FROM user_flow WHERE uid={$_POST['uid']}";
            $flowUser = Yii::app()->db->createCommand($sql)->queryAll();
            $flowLength = count($flowUser);
            if($flowLength>0){
                foreach((array)$flowUser as $v){
                    $userString.=$v['fid'].',';
                }
                $userString = substr($userString,0,-1);
            }
            //加上自已的动态
//            $userString .= $_POST['uid'];
            //歌单动态
            $sql = "SELECT lid FROM list_flow WHERE uid={$_POST['uid']}";
            $flowList = Yii::app()->db->createCommand($sql)->queryAll();
            $listLength = count($flowList);
            if($listLength>0){
                foreach((array)$flowList as $v){
                    $playList.=$v['lid'].',';
                }
                $playList = substr($playList,0,-1);
            }
            $rs = $this->getUserActive($userString,$playList,$_POST['page'],$_POST['uid']);
            //加工数据，将这些数据以几个对象的形式返回手机端
            $data = array();
            $i = 0;
            foreach((array)$rs as $k=>$v){
                if(isset($v['sid'])) $modelSource = MusicSource::model()->findByPk($v['sid']);
                if(isset($v['lid'])) $modelList = MusicList::model()->findByPk($v['lid']);
                if(isset($v['user_id'])) $modelUser = User::model()->findByPk($v['user_id']);
                if(isset($v['fid'])) $modelFlowUser = User::model()->findByPk($v['fid']);
                $data[$i]['source'] = isset($modelSource)?$modelSource->getResponseData():null;
                $data[$i]['list'] = isset($modelList)?$modelList->getResponseData():null;
                $data[$i]['user'] = isset($modelUser)?$modelUser->getResponseData():null;
                $data[$i]['flow_user'] = isset($modelFlowUser)?$modelFlowUser->getResponseData():null;
                $data[$i]['action'] = $v['action'];
                $data[$i]['aid'] = $v['aid'];
                $data[$i]['createtime'] = date('Y-m-d H:i:s',$v['createtime']);
                $i+=1;
            }
            $this->sendDataResponse($data);
        }
    }

    /**
     * 获取用户的动态信息
     * @param $user
     * @return mixed
     */
    private function getUserActive($user=0,$list=0,$page=1,$myId){
        $page_size = 10;
        $start = ($page-1)*$page_size;
        $sql = '';
        if($user && $list && $page){
            $sql = "SELECT b.user_id,
                           a.createtime,a.action,a.id as aid,a.lid,a.sid,a.tid,a.comments,
                           e.user_id AS fid
                FROM user_action AS a
                LEFT JOIN `user` AS b ON(a.uid=b.user_id)
                LEFT JOIN music_list AS c ON(c.lid=a.lid)
                LEFT JOIN music_source AS d ON(d.sid=a.sid)
                LEFT JOIN `user` AS e ON(e.user_id=a.tid)
                WHERE a.uid IN($user) union
                SELECT b.user_id,
                           a.createtime,a.action,a.id as aid,a.lid,a.sid,a.tid,a.comments,
                           e.user_id AS fid
                FROM user_action AS a
                LEFT JOIN `user` AS b ON(a.uid=b.user_id)
                LEFT JOIN music_list AS c ON(c.lid=a.lid)
                LEFT JOIN music_source AS d ON(d.sid=a.sid)
                LEFT JOIN `user` AS e ON(e.user_id=a.tid)
                WHERE a.lid IN($list) and a.uid<>$myId
                GROUP BY a.action,a.lid,a.sid,a.tid
                order by createtime desc limit $start,$page_size";
        }else if($user){
            $sql = "SELECT b.user_id,
                           a.createtime,a.action,a.id as aid,a.lid,a.sid,a.tid,a.comments,
                           e.user_id AS fid
                FROM user_action AS a
                LEFT JOIN `user` AS b ON(a.uid=b.user_id)
                LEFT JOIN music_list AS c ON(c.lid=a.lid)
                LEFT JOIN music_source AS d ON(d.sid=a.sid)
                LEFT JOIN `user` AS e ON(e.user_id=a.tid)
                WHERE a.uid IN($user) and a.uid<>$myId
                GROUP BY a.action,a.lid,a.sid,a.tid
                order by createtime desc limit $start,$page_size";
        }else if($list){
            $sql = "SELECT b.user_id,
                           a.createtime,a.action,a.id as aid,a.lid,a.sid,a.tid,a.comments,
                           e.user_id AS fid
                FROM user_action AS a
                LEFT JOIN `user` AS b ON(a.uid=b.user_id)
                LEFT JOIN music_list AS c ON(c.lid=a.lid)
                LEFT JOIN music_source AS d ON(d.sid=a.sid)
                LEFT JOIN `user` AS e ON(e.user_id=a.tid)
                WHERE a.lid IN($list) and a.uid<>$myId
                GROUP BY a.action,a.lid,a.sid,a.tid
                order by createtime desc limit $start,$page_size";
        }
        if(!$sql) $this->sendSucessResponse('没有动态');
        return Yii::app()->db->createCommand($sql)->queryAll();
    }


    /**
     * 获取歌单动态
     * @param $list
     * @return mixed
     */
//    private function getListActive($list){
//        $sql = "SELECT b.nick_name,b.user_id,b.user_ico_b,a.createtime,a.action,a.lid,a.sid,a.tid,a.comments,c.list_ico,c.list_type,d.name,d.url,d.meid,d.eid,d.ico_big,e.nick_name AS f_user_name,e.user_ico_b AS f_user_ico_b,e.id AS fid
//                FROM user_action AS a
//                LEFT JOIN `user` AS b ON(a.uid=b.user_id)
//                LEFT JOIN music_list AS c ON(c.lid=a.lid)
//                LEFT JOIN music_source AS d ON(d.sid=a.sid)
//                LEFT JOIN `user` AS e ON(e.id=a.tid)
//                WHERE a.lid IN($list)";
//        return Yii::app()->db->createCommand($sql)->queryAll();
//    }

    /**
     * 对歌单加关注或取消关注
     * @uid
     * @token
     * @lid
     */
    public function actionFlowList(){
        if(isset($_POST['uid']) && isset($_POST['token']) && isset($_POST['lid']) && isset($_POST['act'])){
            $model = ListFlow::model()->find('uid=:uid and lid=:lid',array(
                ':uid'=>$_POST['uid'],
                ':lid'=>$_POST['lid']
            ));
            $modelList = MusicList::model()->findByPk($_POST['lid']);
            if($_POST['act'] == 'add'){
                if($model){
                    $this->sendDataResponse($modelList->getResponseData(),'你已关注了此歌单');
                }else{
                    $transaction = Yii::app()->db->beginTransaction();
                    try{
                        $model = new ListFlow();
                        $model->uid = $_POST['uid'];
                        $model->lid = $_POST['lid'];
                        $model->save();

                        //关注后记录到活动表
                        $userAction = new UserAction();
                        $userAction->uid = $_POST['uid'];
                        $userAction->lid = $_POST['lid'];
                        $userAction->comments = '关注了歌单';
                        $userAction->action = $this->userAction['flow_list'];
                        $userAction->createtime = time();
                        $userAction->save();

                        //歌单的关注人数要加1
                        $modelList->flow_num +=1;
                        $modelList->save();

                        $transaction->commit();
                        $this->sendDataResponse($modelList->getResponseData(),'关注歌单成功');
                    }catch (Exception $e){
                        $transaction->rollBack();
                        $this->log('User','FlowList','关注歌单失败'.$e->getMessage());
                        $this->sendErrorResponse('关注歌单失败!');
                    }
                }
            }else if($_POST['act'] == 'del'){
                if(!$model) $this->sendErrorResponse('你没有关注此歌单');
                $model->delete();
                if($modelList->flow_num>0){
                    $modelList->flow_num-=1;
                    $modelList->save();
                }
                $this->sendDataResponse($modelList->getResponseData(),'取消关注歌单成功');
            }
        }
    }


    /**
     * 我关注的人列表
     */
    public function actionMyFlowUser(){
        if(isset($_POST['uid']) && isset($_POST['token']) && isset($_POST['page'])){
            $this->auth($_POST['uid'],$_POST['token']);
            $page_size = 20;
            $start = ($_POST['page']-1)*$page_size;
            $uid = $_POST['uid'];
            if(isset($_POST['target_uid'])){
                $uid = $_POST['target_uid'];
            }
            $sql = "SELECT b.user_id FROM user_flow AS a
                    LEFT JOIN `user` AS b ON(a.fid=b.user_id)
                    WHERE a.uid=$uid limit $start,$page_size";
            $ids = Yii::app()->db->createCommand($sql)->queryAll();
            $data = $this->getUserByIds($ids);
            $this->sendDataResponse($data);
        }
    }

    /**
     * 关注我的人的列表
     */
    public function actionMyFlowedUser(){
        if(isset($_POST['uid']) && isset($_POST['token']) && isset($_POST['page']) ){
            $this->auth($_POST['uid'],$_POST['token']);
            $page_size = 20;
            $start = ($_POST['page']-1)*$page_size;
            $uid = $_POST['uid'];
            if(isset($_POST['target_uid'])){
                $uid = $_POST['target_uid'];
            }
            $sql = "SELECT b.user_id FROM user_flow AS a
                    LEFT JOIN `user` AS b ON(a.uid=b.user_id)
                    WHERE a.fid=$uid order by a.id desc limit $start,$page_size";
            $ids = Yii::app()->db->createCommand($sql)->queryAll();
            $data = $this->getUserByIds($ids);
            $this->sendDataResponse($data);
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
        if(isset($_POST['uid']) && isset($_POST['token'])){
            $this->auth($_POST['uid'],$_POST['token']);
            $userModel = User::model()->findByPk($_POST['uid']);
            $img1 = $img2 = $im1 = $im2 = '';
            if(isset($_POST['user_sig'])){
                $userModel->user_sig = $_POST['user_sig'];
            }

            if(isset($_POST['nick_name'])){
                $userModel->nick_name = $_POST['nick_name'];
            }

            if(isset($_POST['user_ico'])){
                $img1 = $userModel->user_ico_b;
                $im1 = $userModel->user_ico_b = $this->saveStrToImg(trim($_POST['user_ico']));
                $userModel->user_ico_n = $userModel->user_ico_s = $im1;
            }
            if(isset($_POST['user_back_img'])){
                $img2 = $userModel->user_back_img;
                $im2 = $userModel->user_back_img = $this->saveStrToImg(trim($_POST['user_back_img']));
            }
            try{
                if($userModel->save()){
                    if($im1) $this->delFileFromServer($img1);
                    if($im2) $this->delFileFromServer($img2);
                }
            }catch (Exception $e){
                $this->log('User','EditProfile','编辑用户资料出错'.$e->getMessage());
                $this->sendErrorResponse($e->getMessage());
            }
            $tokenModel = UserToken::model()->find('user_id=:user_id',array(
                ':user_id'=>$userModel->user_id
            ));
            $this->sendTwoModelResponse($userModel,$tokenModel);
        }
    }

//    /**
//     * Lists all models.
//     */
//    public function actionIndex()
//    {
//        $dataProvider=new ActiveDataProvider('User');
//        $this->sendAjaxResponse($dataProvider);
//    }

}
