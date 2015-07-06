<?php
$model = new Subscribe();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>linkoak：Free and simple|Create business story and share it on facebook, twitter, linkedin and wechat，etc </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="stylesheet" href="<?php echo SITE_URL?>/custom/css/style.css">
    <!--[if lt IE 10]>
    <script>
        //window.location.href = '/fallback';
    </script>
    <![endif]-->
    <!-- This site is optimized with the Yoast WordPress SEO plugin v1.7.4 - https://yoast.com/wordpress/plugins/seo/ -->
    <meta name="description" content="Create a stunning business story with Linkoak.No coding skills  needed. Choose a template to customize it ,spread your content and achieve better Customer Acquisition today!">
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
	<link rel="shortcut icon" href="<?php echo SITE_URL?>/custom/images/fav.ico" mce_href="<?php echo SITE_URL?>/custom/images/fav.ico" type="image/x-icon" />
    <!-- / Yoast WordPress SEO plugin. -->
</head>
<body>
<div class="nav-slanted"></div>
<!-- Full screen menu -->
<div class="nav-full-screen">
    <a class="logo" href="/"><img src="<?php echo SITE_URL?>/custom/images/logo.png"></a>
    <nav>
<!--        <ul class="nav">-->
<!--            <li class="menu-item menu-item-type-post_type">-->
<!--                <a href="">Home</a></li>-->
<!--            <li class="menu-item menu-item-type-post_type">-->
<!--                <a href="">Partners</a></li>-->
<!--            <li class="menu-item menu-item-type-post_type">-->
<!--                <a href="">Supports</a></li>-->
<!--            <li class="menu-item menu-item-type-post_type">-->
<!--                <a href="">language</a></li>-->
<!--        </ul>-->
        <?php $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'Home','url'=>array('/site/index'),'active'=>$this->action->id=='index','class'=>'menu-item menu-item-type-post_type'),
                array('label'=>'Partners', 'url'=>array('/site/index'),'active'=>$this->action->id=='game'),
                array('label'=>'Support', 'url'=>array('/site/support'),'active'=>$this->action->id=='support'),
                array('label'=>'language', 'url'=>array('/site/index'),'active'=>$this->action->id=='about'),
            ),
            'activeCssClass'=>'menu-item_hover',
            'htmlOptions'=>array(
                'class'=>'nav',
            ),
        )); ?>
    </nav>



    <div style="clear:both; height:0px; overflow:hidden"></div>
</div>
<!-- Logo + hamburger -->

<?php echo $content; ?>

</div><!-- page -->
<!--弹出窗口 11.7修改-->

<div id="close" class="box" style="display: none">
    <div class="beg"></div>
    <div class="cuent" >
        <div class="title">
            <a href="javascript:void(0)" id="close" class="titleBt close">&nbsp;</a></div>
        <div class="box-img">
            <p class="red">Congratulation!</p>
            <p>Stay tuned with the release of linkoak:)</p>
        </div>

    </div>
</div>
<!-- 弹出窗口 end  11.7修改-->


<section id="section-6e2eec9ca19c076736d19ac5426473af" class="section container_own padding-top2 padding-bottom2" style="background-color: #4e4e51; color: #dcdcdc; text-align:left">
    <div class="">
        <div class="row row-equal-columns" style="text-align:left;">
            <div class="column col-md-5 padding-medium padding-tb-default">
                <div class="flex">
                    <div class="block block-text">
                        <header><img draggable="false" src="<?php echo SITE_URL?>/custom/images/yile.png" class="width-7 padd" alt="" title="yile" />	</header>
                        <p>Yile is a leading mobile internet development company with millions of users worldwide. 10+ years Internet experience gives us a unique insight for creating amazing and stunning mobile products. Innovation and creativeness is our ultimate commitment, and we have a great passion for everything mobile and we put this love fully into our work.</p>
                    </div>
                </div>
            </div>
            <div class="column col-md-2 padding-medium padding-tb-default">
                <div class="flex">
                    <div class="block block-text">
                        <header><h2 class="green">NAVIGATION</h2></header>
                        <ul class="navlist">
                            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index');?>" class="fff">Home</a></li>
                            <li>Partners</li>
                            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/support');?>" class="fff">Support</a></li>
                            <li>Term of use</li>
                            <li>Language</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="column col-md-5 padding-medium padding-tb-default">
                <div class="flex">
                    <div class="block block-text">
                        <header><h2 class="green">NEWSLETTER&nbsp;SUBSCRIBE</h2></header>
                        <div class="sub">
                            <?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'subscribe-form4',
                                'enableAjaxValidation'=>true,
                                'enableClientValidation'=>true,
                                'clientOptions'=>array(
                                    'validateOnSubmit'=>true,
                                ),
                                'htmlOptions'=>array(
                                    'onsubmit'=>"return false;",
                                    'onkeypress'=>" if(event.keyCode == 13){ sendemail(\'subscribe-form4\',\'sub_4\'); } "
                                ),
                            )); ?>
                            <?php echo $form->textField($model,'user_email',array(
                                'id'=>'user_email_one',
                                // 'value'=>'Input Your Email',
                                'placeholder'=>'Input Your Email',
                                // 'onclick'=>'if(this.value == \'Input Your Email\'){ this.value=\'\';}',
                                'class'=>'tmail thmail')); ?>
                            <?php echo CHtml::Button('subscribe',array('onclick'=>'sendemail(\'subscribe-form4\',\'sub_4\');','class'=>'orbtn')); ?>
                            <?php $this->endWidget(); ?>
                            <div class="poptip" id="sub_4" style="display:none">
                                <span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
                                <span id="sub_4_text"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer id="footer">
    <div class="copyright ">
        Copyright @2015 YiLe all rights reserved
        <div class="footicon">
            <a href="mailto:support@linkoak.com" target="_blank" ><img src="<?php echo SITE_URL?>/custom/images/message.png"/></a>
            <a href="https://www.facebook.com/linkoak" target="_blank"><img src="<?php echo SITE_URL?>/custom/images/footer_05.png"/></a>
            <a href="https://twitter.com/linkoak" target="_blank"><img src="<?php echo SITE_URL?>/custom/images/footer_07.png"/></a>
        </div>
    </div>
    <!--/ .cppyright-->
</footer>
<script>
    function sendemail(formId,errorId)
    {
        var formId = formId;
        var errorId = errorId;
        var data= $("#"+formId).serialize();
//        alert(errorId);
        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("site/subscribe"); ?>',
            data:data,
            success:function(data){
                if(isInteger(data)){
                    $("#close").show();
                }else{
                    var obj = JSON.parse(data);
                    $('#'+errorId).show();
                    $('#'+errorId+'_text').html(obj.Subscribe_user_email);
                }
            },
            error: function(data) {
                alert("Error occured.please try again");
                //alert(data);
            },
            dataType:'html'
        });
    }
    function isInteger(x) {
        return x % 1 === 0;
    }
    $(function(){
        $("#close").click(function(){
            window.location.href = '/';
        });
    })
</script>
</body>
</html>
