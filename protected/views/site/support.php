<link rel="stylesheet" href="<?php echo SITE_URL?>/custom/css/supports.css">

<div id="content">
<div class="layer">
<div class="transform">
<article id="page-frontpage" class="page">
<!-- welcome语 begin-->
<section class="section no-padding" style="background-color: #11b509;height:300px;">
    <div class="container">
        <div class="row ta-c uniSans">
            <div class="f50 fff mt-90">
                Welcome to Wisape Support
            </div>
            <div class="f50 fff mt-5">
                We are always here, listening to you.
            </div>
        </div>
    </div>
</section>
<!-- welcome语 end-->

<!-- TIPS begin -->
<section class="section no-padding">
    <div class="container mt-65">
        <div class="row ">
            <h2 class="fz-32 c333 b">If you have any ideas or suggestions on Wisape, please feel free to write to us. And we will send you a solution within 24 hours.</h2>
        </div>
    </div>

</section>
<!-- TIPS end -->

<!-- 分享 begin	 -->
<section class="section no-padding">
    <div class="container mt-45">
        <div class="row">
            <h2 class="fz-32 c333 b">Find the best way to get in touch:</h2>
            <div class="row-equal-columns row ta-l mb-5 width-80">
                <div class="col-md-4">
                    <a href="mailto:support@wisape.com" target="_blank">
                        <input class="orbtn share-via-email support-icon" name="yt0" type="button" value="Contact us via E-mail">
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="https://www.facebook.com/pages/Wisape/968758586520540" target="_blank">
                        <input class="orbtn share-via-facebook support-icon" name="yt0" type="button" value="Find us on Facebook">
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="https://twitter.com/WisapeAgency" target="_blank">
                        <input class="orbtn share-via-twitter support-icon" name="yt0" type="button" value="Follow us on Twitter">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- 分享 end -->
<!-- 二维码 begin -->
<section class="section no-padding">
    <div class="container pl-0">
        <div class="row row-equal-columns width-100">
            <div class="width-100">
                <div class="col-md-6">
                    <h2 class="font_size20 ta-l" style="padding-left: 16px;"><span class="support-icon icon-wechat mr-20">&nbsp;</span>Talk to us via WeChat (<span class="fz-14">Our public account ID: Wisape</span>)</h2>
                    <img draggable="false" class="mt-5" src="<?php echo SITE_URL?>/custom/images/yile_weixin.png" style="width:180px;height:180px;">

                </div>
                <div class="col-md-6">
                    <h2 class="font_size20"><span class="support-icon icon-line mr-20">&nbsp;</span>Reach us on Line (<span class="fz-14">Our group ID: wisape</span>)</h2>
                    <img draggable="false" class="mt-5" src="<?php echo SITE_URL?>/custom/images/line_weixin.png" style="width:180px;height:180px;">

                </div>
            </div>

            <div>
            </div>
        </div>
        <!-- 	<div class="row row-equal-columns ta-c">
                <div class="col-md-6">
                    <img draggable="false" src="./custom/images/yile_weixin.png" style="width:250px;height:250px;">
                </div>
                <div class="col-md-6">
                    <img draggable="false" src="./custom/images/line_weixin.png" style="width:250px;height:250px;">
                </div>
            </div> -->
    </div>
</section>
<!-- 二维码 end -->

<!-- 分割线 begin-->
<section class="section no-padding">
    <div class="container mt-30">
        <div class="row">
            <div class="cut-line"></div>
        </div>
    </div>
</section>
<!-- 分割线 end-->

<!-- 留言 begin -->
<section class="section no-padding">
    <div class="container mt-40 mod">
        <div class="row col-md-6 pl-0">
            <h2 class="fz-32 c333 b">Send us a message:</h2>
            <div class="container" style="padding-left:0px;">
                <div class="column col-md-6 padding-medium padding-tb-default pl-0">
                    <div class="flex">
                        <ul class="tform">
                            <?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'send-message-form',
                                'enableAjaxValidation'=>true,
                            )); ?>
                            <?php /* ?>
                            <li>

                                <span class="dn-i width-5 ccc">*</span><?php echo $form->textField($model,'user_name',array(
                                    'maxlength'=>50,
                                    'placeholder'=>'Name',
                                    'class'=>'grabtn width-95 mt-0 tman',
                                )); ?>
                                <div style="display:none" id="SendMessage_user_name_em_" class="poptip">
                                    <span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
                                    <span id="SendMessage_user_name_em_text"></span>
                                </div>
                            </li><?php */ ?>
                            <li>

                                <span class="dn-i width-5 ccc">*</span><?php echo $form->textField($model,'user_email',array(
                                    'size'=>60,
                                    'maxlength'=>100,
                                    'placeholder'=>'Email',
                                    'class'=>'grabtn width-95 thmail',
                                )); ?>
                                <div style="display:none" id="SendMessage_user_email_em_" class="poptip">
                                    <span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
                                    <span id="SendMessage_user_email_em_text"></span>
                                </div>
                            </li>
                            <li>

                                <span class="dn-i width-5 ccc">&nbsp;</span><?php echo $form->textField($model,'subject',array(
                                    'maxlength'=>200,
                                    'class'=>'grabtn width-95 subject',
                                    'placeholder'=>'Subject',
                                )); ?>
                                <div style="display:none" id="SendMessage_subject_em_" class="poptip">
                                    <span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
                                    <span id="SendMessage_subject_em_text"></span>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="column col-md-6 padding-medium padding-tb-default padding-right-none mb-0">
                    <div class="flex">
                        <?php echo $form->textArea($model,'user_message',array(
                            'rows'=>7,
                            'cols'=>50,
                            'class'=>'width-100 grabtn mb-0 mt-0',
                            'placeholder'=>'Your message',
                        )); ?>
                    </div>
                </div>
                <div class="ta-r">
                    <?php echo CHtml::Button('Send Message',array('onclick'=>'sendmessage(\'send-message-form\');','class'=>'grbtn width-18 mt-10')); ?>
                </div>
                <?php $this->endWidget(); ?>
            </div>


        </div>
    </div>
</section>
<!-- 留言 end -->
</article>

</div>
</div>
<script>
    window.onscroll = function(){
        var t = document.documentElement.scrollTop || document.body.scrollTop;
        if( t > $(".bg1").height() ){
            $('.contant .absole').animate({left:'0'},2000);
            $('.absori').animate({right:'0'},2000);
        }
        if( t > $(".bg1").height()+ $(".bg").height()+ $(".bg").height() ) {
            $('.contant3 .absole').animate({left:'0%'},2000);
        }
        if( t > 0 ){
            $('.fix').show();
        }

    }

</script>
<script src="<?php echo SITE_URL?>/custom/js/app.js"></script>
<script type="text/javascript">

    function sendmessage(formId)
    {
        var data= $("#"+formId).serialize();
        var url = '<?php echo Yii::app()->createAbsoluteUrl("site/support"); ?>';
        $.ajax({
            type: 'POST',
            url: url,
            data:data,
            success:function(data){
                if(isInteger(data)){
                    $("#close").show();
                    location.href = '<?php Yii::app()->createAbsoluteUrl('site/support');?>';
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


