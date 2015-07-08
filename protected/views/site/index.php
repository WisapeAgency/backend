<div class="layer">
<div class="transform">
<article id="page-frontpage" class="page">
<!--lunbo-->
<section id="section-f752582986d70327ae2e8dd9aea7f976" class="section no-padding" style="background-color: #000000; color: #2e2e2e;">
    <div class="container-fluid">
        <div class="row row-equal-columns">
            <div class="column no-padding padding-tb-none">
                <div class="flex">
                    <div class="block block-post_slider">
                        <div class="slider slider-post" data-slider-animation-duration="1000" data-slider-interval="8000" data-slider-loop="true" data-slider-parallax-speed="0.5">
                            <div class="wrapper">
                                <div class="scroller" style="width:300%">
                                    <div class="item active">
                                        <div class="parallax-layer">
                                            <div class="image-background">
                                                <img draggable="false" src="<?php echo SITE_URL?>/custom/images/lun01.jpg" class="" alt="" />
                                            </div>
                                        </div>
                                        <div class="content-layer">
                                            <svg class="slider-post-slanting hidden-xs hidden-portrait" viewBox="0 0 2880 1620" height="100%" preserveAspectRatio="xMaxYMax slice" style="position:absolute; bottom: 0px; min-height: 810px;">
                                                <polygon opacity="0.9" fill="#24b011" points="2000,1620 0,1620 0,0 600,0 "/>
                                            </svg>
                                            <img style="position: absolute;width: 120px;left: 50px;" src="<?php echo SITE_URL?>/custom/images/freeTag.png"/>
                                            <div class="slider-post-content" style="margin-top: 75px;">
                                                <div class="slider-post-fill" style="background-color: #f9b635"></div>
                                                <header>
                                                    <h1 style="font-size: 36px;">Wisape helps your business </h1>
                                                    <!--<p class="subheading">Case study</p>-->
                                                </header>
                                                <p style="text-transform: uppercase;font-family: Arial;color: #ffdd3e;font-weight: bold;">get more target customers and improve measurable ROI(Return On Investment)</p>
                                                <div class="sbtn">
                                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'subscribe-form',
                                                        'enableAjaxValidation'=>true,
                                                        'enableClientValidation'=>true,
                                                        'htmlOptions'=>array(
                                                            'onsubmit'=>"return false;",
                                                            'onkeypress'=>"if(event.keyCode == 13){ sendemail(\'subscribe-form\',\'sub_1\'); }"
                                                        ),
                                                        'clientOptions'=>array(
                                                            'validateOnSubmit'=>true,
                                                        ),

                                                    )); ?>
                                                    <?php echo $form->textField($model,'user_email',array(
                                                        'id'=>'user_email_one',
                                                        'placeholder'=>'Input Your Email',
                                                        // 'value'=>'Input Your Email',
                                                        // 'onclick'=>'if(this.value == \'Input Your Email\'){ this.value=\'\';}',
                                                        'class'=>'smail qgreen',
                                                        'size'=>60,
                                                        'maxlength'=>255
                                                    )); ?>
                                                    <?php echo CHtml::Button('subscribe',array('onclick'=>'sendemail(\'subscribe-form\',\'sub_1\');','class'=>'orbtn')); ?>
                                                    <?php $this->endWidget(); ?>
                                                    <div class="poptip" id="sub_1" style="display:none">
                                                        <span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
                                                        <span id="sub_1_text"></span>
                                                    </div>
                                                    <span class="small mt5" style="margin-left: 8px;">Free to apply for it now</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="parallax-layer">
                                            <div class="image-background">
                                                <img draggable="false" src="<?php echo SITE_URL?>/custom/images/lun02.jpg"  class="" alt="" />
                                            </div>
                                        </div>
                                        <div class="content-layer">
                                            <svg class="slider-post-slanting hidden-xs hidden-portrait" viewBox="0 0 2880 1620" height="100%" preserveAspectRatio="xMaxYMax slice" style="position:absolute; bottom: 0px; min-height: 810px;">
                                                <polygon opacity="0.9" fill="#37a5df" points="2000,1620 0,1620 0,0 600,0 "/>
                                            </svg>

                                            <div class="slider-post-content" style="margin-top:105px;">
                                                <div class="slider-post-fill" style="background-color: #002395"></div>
                                                <header>
                                                    <h1 style="font-size: 48px;color: #ffdd3e;">1 minute</h1>
                                                </header>
                                                <p style="text-transform: uppercase;font-family: Arial;font-weight: bold;">create your stunning business story
                                                </p>
                                                <div class="sbtn">
                                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'subscribe-form2',
                                                        'enableAjaxValidation'=>true,
                                                        'enableClientValidation'=>true,
                                                        'clientOptions'=>array(
                                                            'validateOnSubmit'=>true,
                                                        ),
                                                    )); ?>
                                                    <?php echo $form->textField($model,'user_email',array(
                                                        'id'=>'user_email_one',
                                                        'placeholder'=>'Input Your Email',
                                                        // 'value'=>'Input Your Email',
                                                        // 'onclick'=>'if(this.value == \'Input Your Email\'){ this.value=\'\';}',
                                                        'class'=>'smail blue','size'=>60,'maxlength'=>255)); ?>
                                                    <?php echo CHtml::Button('subscribe',array('onclick'=>'sendemail(\'subscribe-form2\',\'sub_2\');','class'=>'orbtn')); ?>
                                                    <?php $this->endWidget(); ?>
                                                    <div class="poptip" id="sub_2" style="display:none">
                                                        <span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
                                                        <span id="sub_2_text"></span>
                                                    </div>
                                                    <span class="small mt5" style="margin-left: 8px;">Free to apply for it now</span>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="item">
                                        <div class="parallax-layer">
                                            <div class="image-background">
                                                <img draggable="false" src="<?php echo SITE_URL?>/custom/images/lun03.jpg" class="" alt="" />
                                            </div>
                                        </div>
                                        <div class="content-layer">
                                            <svg class="slider-post-slanting hidden-xs hidden-portrait" viewBox="0 0 2880 1620" height="100%" preserveAspectRatio="xMaxYMax slice" style="position:absolute; bottom: 0px; min-height: 810px;">
                                                <polygon opacity="0.9" fill="#16191c" points="2000,1620 0,1620 0,0 600,0 "/>
                                            </svg>

                                            <div class="slider-post-content" style="margin-top: 70px;">
                                                <div class="slider-post-fill" style="background-color: #647077"></div>

                                                <header>
                                                    <h2 style="text-transform: uppercase;color: #f9c615;">Promote story in</h2>
                                                    <h1 style="text-transform: uppercase;color: #f9c615;">multiple  channels</h1>
                                                </header>
                                                <p style="font-family:Arial;">
                                                    Find out your analytics data and report
                                                </p>
                                                <div class="sbtn">
                                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'subscribe-form3',
                                                        'enableAjaxValidation'=>true,
                                                        'enableClientValidation'=>true,
                                                        'clientOptions'=>array(
                                                            'validateOnSubmit'=>true,
                                                        ),
                                                        'htmlOptions'=>array(
                                                            'onsubmit'=>"return false;",
                                                            'onkeypress'=>"if(event.keyCode == 13){ sendemail(\'subscribe-form3\',\'sub_3\'); }"
                                                        ),

                                                    )); ?>
                                                    <?php echo $form->textField($model,'user_email',array(
                                                        'id'=>'user_email_one',
                                                        'placeholder'=>'Input Your Email',
                                                        // 'value'=>'Input Your Email',
                                                        // 'onclick'=>'if(this.value == \'Input Your Email\'){ this.value=\'\';}',
                                                        'class'=>'smail orange','size'=>60,'maxlength'=>255)); ?>
                                                    <?php echo CHtml::Button('subscribe',array('onclick'=>'sendemail(\'subscribe-form3\',\'sub_3\');','class'=>'orbtn')); ?>
                                                    <?php $this->endWidget(); ?>
                                                    <div class="poptip" id="sub_3" style="display:none">
                                                        <span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
                                                        <span id="sub_3_text"></span>
                                                    </div>
                                                    <span class="small mt5" style="margin-left: 8px;">Free to apply for it now</span>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <ol class="slider-indicators">
                                <li>0</li>
                                <li>1</li>
                                <li>2</li>
                            </ol>
                            <div class="slider-control"></div>
                            <div class="slider-control right"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--lunbo-->

<!--4 图-->
<section id="section-3e9e39fed3b8369ed940f52cf300cf88" class="section padding-top padding-bottom" style="background: #fff; color: #262626;">
    <div class="container">
        <div class="row">
            <div class="column col-md-12 padding-medium padding-tb-default">
                <div class="flex align-center">
                    <h1>Features</h1>
                    <hr class=" brgreen">
                </div>
            </div>
        </div>
        <div class="row row-equal-columns">
            <div class="column col-md-6 padding-medium padding-tb-default">
                <div class="flex">
                    <div class="block block-image">
                        <img draggable="false" src="<?php echo SITE_URL?>/custom/images/one.png" srcset="<?php echo SITE_URL?>/custom/images/one.png 750w, <?php echo SITE_URL?>/custom/images/one.png 1280w, <?php echo SITE_URL?>/custom/images/one.png" class="width-50 center" alt="" title="one.png" />
                    </div>
                    <div class="block block-text">
                        <header>
                            <h2 class="align-center font_size30">Wise Story Builder</h2>
                        </header>
                        <p class="p1">No technical skills required. Click, choose, drag, your business story page is done! Wisape can prove it.</p>
                    </div>
                </div>
            </div>
            <div class="column col-md-6 padding-medium padding-tb-default">
                <div class="flex">
                    <div class="block block-image">
                        <img draggable="false" src="<?php echo SITE_URL?>/custom/images/two.png" srcset="<?php echo SITE_URL?>/custom/images/two.png 750w, <?php echo SITE_URL?>/custom/images/two.png 1280w, <?php echo SITE_URL?>/custom/images/two.png" class="width-50 center" alt="" title="two.png" />
                    </div>
                    <div class="block block-text">
                        <header>
                            <h2 class="align-center font_size30">Easy and Fast</h2>
                        </header>
                        <p class="p1">Any business owner can build the masterpiece page nicely and wisely.  Wisape offers various page templates as your options. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-equal-columns">
            <div class="column col-md-6 padding-medium padding-tb-default">
                <div class="flex">
                    <div class="block block-image">
                        <img draggable="false" src="<?php echo SITE_URL?>/custom/images/three.png" srcset="<?php echo SITE_URL?>/custom/images/three.png 750w, <?php echo SITE_URL?>/custom/images/three.png 1280w, <?php echo SITE_URL?>/custom/images/three.png" class="width-50 center" alt="" title="Stupid_Studio_Frontpage_hotdog_Rev2" />
                    </div>
                    <div class="block block-text">
                        <header>
                            <h2 class="align-center font_size30">Reach and Engage</h2></header>
                        <p class="p1">Reach new target customers anytime anywhere using you phone. Wisape spreads your business on Facebook, Twitter, Instagram, LINE, and more channels. People even can scan your Wisape QR code wherever you want them to see!</p>
                    </div>
                </div>
            </div>
            <div class="column col-md-6 padding-medium padding-tb-default">
                <div class="flex">
                    <div class="block block-image">
                        <img draggable="false" src="<?php echo SITE_URL?>/custom/images/four.png" srcset="<?php echo SITE_URL?>/custom/images/four.png 750w, <?php echo SITE_URL?>/custom/images/four.png 1280w, <?php echo SITE_URL?>/custom/images/four.png" class="width-50 center" alt="" title="Stupid_Studio_Frontpage_proces_rev2" />
                    </div>
                    <div class="block block-text">
                        <header><h2 class="align-center font_size30">Customer Activities Updates</h2></header>
                        <p class="p1">You will get a full sight of the exactly amount of "View" and "Like" that your page get from Wisape. Furthermore, our premium features allow you check all templates in different fields to modify your marketing strategies to reach your goal. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!--4 图-->

<!--3 图-->
<section id="section-0070d23b06b1486a538c0eaa45dd167a" class="section">
    <div class="bg">
        <img src="<?php echo SITE_URL?>/custom/images/step1.jpg" width="100%" height="100%"/>
        <div class="contant">
            <div class= "absole" style="background-color:#11b509;">
                <h3>Online Retailers</h3>
                <p>For e-commerce and social commerce, Wisape helps you create crafted promotion pages for the products, events and brands. For more important, you will see the significant increase of your customers, sales and ROI. It's time to take your business to the next level.</p>
            </div>
        </div>
    </div>
    <div class="bg">
        <img src="<?php echo SITE_URL?>/custom/images/step2.jpg" width="100%" height="100%"/>
        <div class="contant">
            <div class="absori" style="background-color:#218dd7;">
                <h3>Local Business Owners</h3>
                <p>Your business goes online from now on. It is time to say bye to long distance relationship with your customer. After quick creating and promoting your business using Wisape, your potential customers will notice you from social net work in the other side of the world. </p>
            </div>
        </div>
    </div>
    <div class="bg">
        <img src="<?php echo SITE_URL?>/custom/images/step3.jpg" width="100%" height="100%"/>
        <div class="contant">
            <div class= "absole" style="background-color:#2f3135;">
                <h3>For You Right Now</h3>
                <p>Wisape offers customized solutions for your business. If you are a restaurant owner, our services include booking, groupon, discount, and more. </p>
            </div></div>
    </div>
</section>

<!--form-->
<section id="section-3e9e39fed3b8369ed940f52cf300cf88" class="section padding-top padding-bottom" style="background: #fff; color: #262626; padding-top:100px;">
    <div class="row">
        <div class="column col-md-12 padding-medium padding-tb-default">
            <div class="flex align-center">
                <h1>Join Beta Here for <span style="color:red;">FREE！</span></h1>
                <hr class="brgreen">
            </div>
        </div>
    </div>
    <div class="row row-equal-columns">
        <div class="column col-md-12 padding-medium padding-tb-default">
            <div class="flex">
                <div class="block block-text align-center">
                    <p class="p1">Please input your email below, we will make you being one of first users once we release the beta version.</p>
                    <div class="padding-bottom" style="margin-bottom:14px;">
                        <input type="button" value="I’m a business owner" class="grbtn" id="J-RFBBtn">
                        <input type="button" value="I’m an individual" class="yebtn"  id="J-RFPBtn">
                    </div>
                    <div id="J-RFB" class="mod">
                        <div class="tarr"><div class="tarrow">&nbsp; </div></div>
                        <div class="container">
                            <div class="column col-md-6 padding-medium padding-tb-default">
                                <div class="flex">
                                    <header><h3 class="align-left">Required</h3></header>
                                    <ul class="tform">
                                        <?php $form=$this->beginWidget('CActiveForm', array(
                                            'id'=>'request-form-b',
                                            'enableAjaxValidation'=>true,
                                            'enableClientValidation'=>true,
                                            'htmlOptions'=>array(
                                                'onsubmit'=>"return false;",
                                                'onkeypress'=>" if(event.keyCode == 13){ send(\'request-form-b\'); } "
                                            ),
                                        )); ?>
                                        <?php echo $form->hiddenField($request_model_b,'req_type',array('value'=>1)); ?>
                                        <li>
                                            <?php echo $form->textField($request_model_b,'first_name',array(
                                                'class'=>'grabtn width-49 tman',
                                                'placeholder'=>'First Name',
                                                // 'value'=>'First Name',
                                                // 'onclick'=>'if(this.value == \'First Name\'){ this.value=\'\';}else if(this.value==\'\'){ this.value=\'First Name\';}'
                                            )); ?>
                                            <div style="display:none" id="Request_first_name_em_" class="poptip">
                                                <span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
                                                <span id="Request_first_name_em_text"></span>
                                            </div>
                                            <?php echo $form->textField($request_model_b,'last_name',array(
                                                'class'=>'grabtn width-49 tman',
                                                'placeholder'=>'Last Name',
                                                // 'value'=>'Last Name',
                                                // 'onclick'=>'if(this.value == \'Last Name\'){ this.value=\'\';}else if(this.value==\'\'){ this.value=\'Last Name\';}'
                                            )); ?>
                                            <div style="display:none" id="Request_last_name_em_" class="poptip type2">
                                                <span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
                                                <span id="Request_last_name_em_text"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <?php echo $form->textField($request_model_b,'company_name',array(
                                                'class'=>'grabtn width-100 thou',
                                                'placeholder'=>'Company Name'
                                                //'onclick'=>'if(this.value == \'Company Name\'){ this.value=\'\';}else if(this.value==\'\'){ this.value=\'Company Name\';}'
                                            )); ?>
                                            <div style="display:none" id="Request_company_name_em_" class="poptip">
                                                <span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
                                                <span id="Request_company_name_em_text"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <?php
                                            $this->widget('ext.CountrySelectorWidget', array(
                                                'value' => $request_model_b->country,
                                                'name' => Chtml::activeName($request_model_b, 'country'),
                                                'id' => Chtml::activeId($request_model_b, 'country'),
                                                'useCountryCode' => false,
                                                'firstEmpty' => true,
                                                'cssClass'=>'grabtn width-100 tbiao'
                                            ));
                                            ?>
                                            <div style="display:none" id="Request_country_em_" class="poptip">
                                                <span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
                                                <span id="Request_country_em_text"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <?php echo $form->textField($request_model_b,'user_email',array(
                                                'class'=>'grabtn width-100 thmail',
                                                'placeholder'=>'Email',
                                                // 'value'=>'Email',
                                                // 'onclick'=>'if(this.value == \'Email\'){ this.value=\'\';}else if(this.value==\'\'){ this.value=\'Email\';}'
                                            )); ?>
                                            <div style="display:none" id="Request_user_email_em_" class="poptip">
                                                <span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
                                                <span id="Request_user_email_em_text"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="column col-md-6 padding-medium padding-tb-default">
                                <div class="flex">
                                    <header><h3 class="align-left">Content</h3></header>
                                    <?php echo $form->textArea($request_model_b,'message',array(
                                        'class'=>'width-100 grabtn',
                                        'rows'=>9,
                                        'placeholder'=>'message',
                                        // 'value'=>'       message'
                                    )); ?>
                                </div>
                            </div>
                            <?php echo CHtml::Button('Send Message',array('onclick'=>'send(\'request-form-b\');','class'=>'grbtn width-92')); ?>
                            <?php $this->endWidget(); ?>
                        </div>
                    </div>
                    <div id="J-RFP" class="mod modR none">
                        <div class="tarr tarrR"><div class="tarrow tarrowR">&nbsp; </div></div>
                        <div class="container">
                            <div class="column col-md-6 padding-medium padding-tb-default">
                                <div class="flex">
                                    <header><h3 class="align-left">Required</h3></header>
                                    <ul class="tform">
                                        <?php $form=$this->beginWidget('CActiveForm', array(
                                            'id'=>'request-form-c',
                                            'enableAjaxValidation'=>true,
                                            'enableClientValidation'=>true,
                                            'htmlOptions'=>array(
                                                'onsubmit'=>"return false;",/* Disable normal form submit */
                                                'onkeypress'=>" if(event.keyCode == 13){ send(\'request-form-c\'); } "
                                            ),
                                        )); ?>
                                        <?php echo $form->hiddenField($model_p,'req_type',array('value'=>1)); ?>
                                        <li>
                                            <?php echo $form->textField($model_p,'first_name',array(
                                                'class'=>'grabtn width-49 tman',
                                                'placeholder'=>'First Name'
//                                                'value'=>'First Name',
//                                                'onclick'=>'if(this.value == \'First Name\'){ this.value=\'\';}else if(this.value==\'\'){ this.value=\'First Name\';}'
                                            )); ?>
                                            <div class="poptip" id="RequestPerson_first_name_em_" style="display: none">
                                                <span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
                                                <span id="RequestPerson_first_name_em_text"></span>
                                            </div>
                                            <?php echo $form->textField($model_p,'last_name',array('class'=>'grabtn width-49 tman','value'=>'Last Name','onclick'=>'if(this.value == \'Last Name\'){ this.value=\'\';}else if(this.value==\'\'){ this.value=\'Last Name\';}')); ?>
                                            <div class="poptip type2" id="RequestPerson_last_name_em_" style="display: none">
                                                <span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
                                                <span id="RequestPerson_last_name_em_text"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <?php
                                            $this->widget('ext.CountrySelectorWidget', array(
                                                'value' => $model_p->country,
                                                'name' => Chtml::activeName($model_p, 'country'),
                                                'id' => Chtml::activeId($model_p, 'country'),
                                                'useCountryCode' => false,
                                                'firstEmpty' => true,
                                                'cssClass'=>'grabtn width-100 tbiao'
                                            ));
                                            ?>
                                            <div class="poptip" id="RequestPerson_country_em_" style="display: none">
                                                <span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
                                                <span id="RequestPerson_country_em_text"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <?php echo $form->textField($model_p,'user_email',array(
                                                'class'=>'grabtn width-100 thmail',
                                                'placehoder'=>'Email'
//                                                'value'=>'Email',
//                                                'onclick'=>'if(this.value == \'Email\'){ this.value=\'\';}else if(this.value==\'\'){ this.value=\'Email\';}'
                                            )); ?>
                                            <div class="poptip" id="RequestPerson_user_email_em_" style="display: none">
                                                <span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
                                                <span id="RequestPerson_user_email_em_text"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="column col-md-6 padding-medium padding-tb-default">
                                <div class="flex">
                                    <header><h3 class="align-left">Content</h3></header>
                                    <?php echo $form->textArea($model_p,'message',array('class'=>'width-100 grabtn','rows'=>9,'value'=>'       message')); ?>
                                </div>
                            </div>
                            <?php echo CHtml::Button('Send Message',array('onclick'=>'send(\'request-form-c\');','class'=>'grbtn width-92')); ?>
                            <?php $this->endWidget(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!--form-->

</article>

</div>
</div>


<!-- The grid -->
<div id="grid">
    <div class="container">
        <div class="row">
            <div class="col-sm-1"><div></div></div>
            <div class="col-sm-1"><div></div></div>
            <div class="col-sm-1"><div></div></div>
            <div class="col-sm-1"><div></div></div>
            <div class="col-sm-1"><div></div></div>
            <div class="col-sm-1"><div></div></div>
            <div class="col-sm-1"><div></div></div>
            <div class="col-sm-1"><div></div></div>
            <div class="col-sm-1"><div></div></div>
            <div class="col-sm-1"><div></div></div>
            <div class="col-sm-1"><div></div></div>
            <div class="col-sm-1"><div></div></div>
        </div>
    </div>
</div>
<script>
    window.onscroll = function(){
        var t = document.documentElement.scrollTop || document.body.scrollTop;
        if( t > $(".bg1").height() ){
            $('.contant .absole').animate({right:'0'},2000);
            $('.absori').animate({left:'0'},2000);
        }
        if( t > $(".bg1").height()+ $(".bg").height()+ $(".bg").height() ) {
            $('.contant3 .absole').animate({right:'0%'},2000);
        }
        if( t > 0 ){
            $('.fix').show();
        }

    }

</script>
<script src="<?php echo SITE_URL?>/custom/js/app.js"></script>
<script type="text/javascript">
    function isInteger(x) {
        return x % 1 === 0;
    }
    function send(formId)
    {
        var data= $("#"+formId).serialize();
        var url = '<?php echo Yii::app()->createAbsoluteUrl("site/createb"); ?>';
        var url2 = '<?php echo Yii::app()->createAbsoluteUrl("site/createc"); ?>';
        if(formId == 'request-form-c'){
            url = url2;
        }
        $.ajax({
            type: 'POST',
            url: url,
            data:data,
            success:function(data){
                if(isInteger(data)){
                    $("#close").show();
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

    $(function(){
        $("#J-RFBBtn").on("click",function(){
            $("#J-RFB").removeClass("none");
            $("#J-RFP").addClass("none");
        })
        $("#J-RFPBtn").on("click",function(){
            $("#J-RFB").addClass("none");
            $("#J-RFP").removeClass("none");
        })


    })


</script>