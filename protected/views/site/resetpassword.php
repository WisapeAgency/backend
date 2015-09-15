
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Wisape：Free and simple|Something Wonderful is Coming.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="stylesheet" href="<?php echo SITE_URL?>/custom/css/password.css">
    <!--[if lt IE 10]>
    <script>
        //window.location.href = '/fallback';
    </script>
    <![endif]-->
    <!-- This site is optimized with the Yoast WordPress SEO plugin v1.7.4 - https://yoast.com/wordpress/plugins/seo/ -->
    <meta name="description" content="Free and simple|Something Wonderful is Coming.">
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
	<link rel="shortcut icon" href="<?php echo SITE_URL?>custom/images/fav.ico" mce_href="<?php echo SITE_URL?>/custom/images/fav.ico" type="image/x-icon" />
    <!-- / Yoast WordPress SEO plugin. -->
</head>
<body>
<div class="body">
		<div class="header">
			<div class="logo">
				<a href="<?php echo SITE_URL?>">
					<img src="<?php echo SITE_URL?>custom/mail-icon/logo.png">
				</a>
			</div>
		</div>
		<div class="content">
			<div class="content_cyp"><img src="<?php echo SITE_URL?>custom/mail-icon/content_cyp.png"></div>
			<p class="content_p">Please enter a new password for your account in the fields below</p>
			<?php $form = $this->beginWidget('CActiveForm', array(
                                            'id'=>'resetPWD',
                                            'enableClientValidation'=>true,
                                            'htmlOptions'=>array(
                                                'onsubmit'=>"return false;",
                                            ),
                                        ));
			?>
			<?php echo $form->hiddenField($resetPWD,'user_id',array(
					'value'=>$resetPWD->user_id,
			))?>
			<div class="content_form">
				<label class="content_form_label">
					<span class="content_form_span">Password</span>
					<?php  echo  $form->passwordField($resetPWD,'password',array(
                                                'class'=>'content_form_input',
                                            )); 
					?>
					<div class="poptip" id="ResetPWD_password_em_" style="display: none">
					<span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
					<span id="ResetPWD_password_em_text"></span>
					</div>
					<!-- <input type="password" class="content_form_input" /> -->
				</label>
				<label class="content_form_label">
					<span class="content_form_span">Confirm Password</span>
					<!-- <input type="password" class="content_form_input" /> -->
					<?php  echo  $form->passwordField($resetPWD,'confirm_password',array(
                                                'class'=>'content_form_input',
                                            )); 
					?>
					<div class="poptip" id="ResetPWD_confirm_password_em_" style="display: none">
					<span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
					<span id="ResetPWD_confirm_password_em_text"></span>
					</div>
				</label>
			</div>
			<div class="content_submit">
				<input type="submit" class="content_form_input1" value="Change Password" onclick="send('resetPWD')"/>
			</div>
			<?php $this ->endWidget(); ?>
		</div>
	</div>

<script language="JavaScript" type="text/javascript" src="<?php echo SITE_URL?>custom/js/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo SITE_URL?>custom/js/index.js"></script>
<script type="text/javascript">
function send(formId){
	var data= $("#"+formId).serialize();
    var url = '<?php echo Yii::app()->createAbsoluteUrl("site/updatePwd"); ?>';
    $.ajax({
        type: 'POST',
        url: url,
        data:data,
        success:function(data){
            if(!isNaN(data)){
                window.location = "<?php echo SITE_URL.'index.php/site/updateSucess' ?>";
            }else{
                var obj = JSON.parse(data);
                $.each(obj, function(key, value) {
                    $('#'+key+'_em_').show();
                    $('#'+key+'_em_text').html(value.toString())
                });
            }
        },
        error: function(data) {
            alert("Error occured.please try again");
            //alert(data);
        },
        dataType:'html'
    });

}

</script>
</body>
</html>