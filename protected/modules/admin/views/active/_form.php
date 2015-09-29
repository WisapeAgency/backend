<?php
/* @var $this ActiveController */
/* @var $model Active */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'active-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bg_img'); ?>
		<?php echo $form->textField($model,'bg_img',array('size'=>60,'maxlength'=>255,'id'=>'bg_img')); ?>
		<?php echo $form->error($model,'bg_img'); ?>
        <img id="pre_bg" src="<?php echo $model->bg_img?$model->bg_img:SITE_URL.'uploads/nopic.jpg'?>" width="100px">
        <?php
        $this->widget('ext.EAjaxUpload.EAjaxUploadWidget', array(
            'id'=>CHtml::getIdByName('MyAjaxUpload'),
            'config'=>array(
                'request'=>array(
                    'endpoint'=>Yii::app()->createUrl('site/ajaxUpload'),
                	'params'=>array('module'=>'active', 'file_type'=>'jpg,png,jpeg,bmp')
                ),
                'callbacks' => array(
                    'onComplete'=>"js:function(id, fileName, responseJSON){
                    $(\"#bg_img\").val(responseJSON.filename);
                    $(\"#pre_bg\").attr('src',responseJSON['filename']);
                }",
                    'onProgress'=>"js:function(id, fileName, loaded,total){}",
                ),
                'template' => '<div class="qq-uploader span12">'
                    .'<div class="qq-upload-button btn btn-success">Upload a image</div>'
                    .'<pre class="qq-upload-drop-area span12"><span>{dragZoneText}</span></pre>'
                    .'<span class="qq-drop-processing"><span>{dropProcessingText}</span><span class="qq-drop-processing-spinner"></span></span>'
                    .'<ul class="qq-upload-list" style="margin-top: 10px; text-align: center;width:50%"></ul>'
                    .'</div>',
                'classes' => array(
                    'success' => 'alert alert-success',
                    'fail' => 'alert alert-error'
                ),
            )
        ));
        ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'rec_status'); ?>
        <?php echo $form->DropDownList($model,'rec_status',array('A'=>'激活','D'=>'不激活')); ?>
        <?php echo $form->error($model,'rec_status'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_time'); ?>
        <?php
        $this->widget('ext.my97DatePicker.JMy97DatePicker',array(
            'name'=>CHtml::activeName($model,'start_time'),
            'value'=>$model->start_time?$model->start_time:'',
            'options'=>array('dateFmt'=>'yyyy-MM-dd HH:mm'),
        ));
        ?>
        <?php echo $form->error($model,'start_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_time'); ?>
        <?php
        $this->widget('ext.my97DatePicker.JMy97DatePicker',array(
            'name'=>CHtml::activeName($model,'end_time'),
            'value'=>$model->end_time?$model->end_time:'',
            'options'=>array('dateFmt'=>'yyyy-MM-dd HH:mm'),
        ));
        ?>
		<?php echo $form->error($model,'end_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
        <?php
        $this->widget('ext.CountrySelectorWidget', array(
            'value' => $model->country,
            'name' => Chtml::activeName($model, 'country'),
            'id' => Chtml::activeId($model, 'country'),
            'useCountryCode' => true,
            'firstEmpty' => true,
            'cssClass'=>'grabtn width-100 tbiao'
        ));
        ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->