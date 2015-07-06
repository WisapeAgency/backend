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
                                            <div class="slider-post-content">
                                                <div class="slider-post-fill" style="background-color: #f9b635"></div>
                                                <header>
                                                    <h1>LINKOAK </h1>
                                                    <!--<p class="subheading">Case study</p>-->
                                                </header>
                                                <p><span>Make outstanding business stories. It’s FREE! </span>Linkoak helps you make great web apps that promote your business using your phone without cost.</p>
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
                                                    <span class="small mt5">Free to apply for it now</span>
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

                                            <div class="slider-post-content">
                                                <div class="slider-post-fill" style="background-color: #002395"></div>
                                                <header>
                                                    <h1>PAINLESS TO USE</h1>
                                                </header>
                                                <p>Literally anyone with almost no technical capabilities can create a stunning mobile HTML5 page using Linkoak.<br />Your efficiency matters, we can improve it.
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

                                                    <span class="small mt5">Free to apply for it now</span>
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
                                                <polygon opacity="0.9" fill="#f2b931" points="2000,1620 0,1620 0,0 600,0 "/>
                                            </svg>

                                            <div class="slider-post-content">
                                                <div class="slider-post-fill" style="background-color: #647077"></div>

                                                <header>
                                                    <h1>Social, Share, Expand</h1>

                                                </header>
                                                <p>
                                                    Tell your Business Story to Expand your brand on your phone.<br />Share your story on Facebook, Twitter, and more throughout the world. It’s time to take your business to the next level.
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
                                                    <span class="small mt5">Free to apply for it now</span>
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
                    <h1>Product function</h1>
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
                            <h2 class="align-center font_size30">Business Story Builder</h2>
                        </header>
                        <p class="p1">Literally anyone with almost no technical capabilities can create a stunning mobile HTML5 page using Linkoak.<br />Your efficiency matters, we can improve it.</p>
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
                            <h2 class="align-center font_size30">Simple and Efficient</h2>
                        </header>
                        <p class="p1">Drag, click, and within 5 minutes, your elegant business story will come out.</p>
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
                            <h2 class="align-center font_size30">Branching Out Your Business</h2></header>
                        <p class="p1">Branch out your business into a strong, dense oak tree: With Linkoak, your business story will spread from point to point, and then point to side with multi channels like Facebook, Instagram, WeChat, and throughout the world.</p>
                    </div>
                </div>
            </div>
            <div class="column col-md-6 padding-medium padding-tb-default">
                <div class="flex">
                    <div class="block block-image">
                        <img draggable="false" src="<?php echo SITE_URL?>/custom/images/four.png" srcset="<?php echo SITE_URL?>/custom/images/four.png 750w, <?php echo SITE_URL?>/custom/images/four.png 1280w, <?php echo SITE_URL?>/custom/images/four.png" class="width-50 center" alt="" title="Stupid_Studio_Frontpage_proces_rev2" />
                    </div>
                    <div class="block block-text">
                        <header><h2 class="align-center font_size30">Monitoring Your Campaigns</h2></header>
                        <p class="p1"> Linkoak keeps records of traffic for your campaigns. You will see the activity of how many people follow and share your stories, and then you will be able to see the big picture for your business. </p>
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
            <div class= "absole">
                <p>Mike is the manager of a food store and he wants to tell local people the latest discounts</p>
                <h3>What interests you?</h3>
            </div></div>
    </div>
    <div class="bg">
        <img src="<?php echo SITE_URL?>/custom/images/step2.jpg" width="100%" height="100%"/>
        <div class="contant">
            <div class="absori">
                <p>Today is their wedding anniversary,Jack and Rosanne want to share their past 10 years happy married life</p>
                <h3>What do you want to share?</h3>
            </div>
        </div>
    </div>
    <div class="bg">
        <img src="<?php echo SITE_URL?>/custom/images/step3.jpg" width="100%" height="100%"/>
        <div class="contant">
            <div class= "absole">
                <p>Beth is an owner of a nail service salon and she wants to expand and keep her client base</p>
                <h3>What inspires you?</h3>
            </div></div>
    </div>
</section>

<!--form-->
<section id="section-3e9e39fed3b8369ed940f52cf300cf88" class="section padding-top padding-bottom" style="background: #fff; color: #262626; padding-top:100px;">
    <div class="row">
        <div class="column col-md-12 padding-medium padding-tb-default">
            <div class="flex align-center">
                <h1>REGISTER TO BE A TRIAL USER</h1>
                <hr class="brgreen">
            </div>
        </div>
    </div>
    <div class="row row-equal-columns">
        <div class="column col-md-12 padding-medium padding-tb-default">
            <div class="flex">
                <div class="block block-text align-center">
                    <p class="p1">Simple and effective – experience a new-generation solution for spreading your value and interests with linkoak. Contact us to get more benefits.</p>
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
                                        'rows'=>11,
                                        'placeholder'=>'message',
                                        // 'value'=>'       message'
                                    )); ?>
                                </div>
                            </div>
                            <?php echo CHtml::Button('Send Mesaage',array('onclick'=>'send(\'request-form-b\');','class'=>'grbtn width-92')); ?>
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
                                    <?php echo $form->textArea($model_p,'message',array('class'=>'width-100 grabtn','rows'=>11,'value'=>'       message')); ?>
                                </div>
                            </div>
                            <?php echo CHtml::Button('Send Mesaage',array('onclick'=>'send(\'request-form-c\');','class'=>'grbtn width-92')); ?>
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