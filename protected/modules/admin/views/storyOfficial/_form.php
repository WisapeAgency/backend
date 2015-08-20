<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'story-official-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zip_url'); ?>
		<?php echo $form->textField($model,'zip_url',array('size'=>60,'maxlength'=>500,'id'=>'zip_url')); ?>
		<?php echo $form->error($model,'zip_url'); ?>
		<?php
        $this->widget('ext.EAjaxUpload.EAjaxUploadWidget', array(
            'id'=>CHtml::getIdByName('zipurl'),
            'config'=>array(
                'request'=>array(
                    'endpoint'=>Yii::app()->createUrl('site/ajaxUpload'),
                    $allowedExtensions = array("zip")
                ),
                'callbacks' => array(
                    'onComplete'=>"js:function(id, fileName, responseJSON){
                    $(\"#zip_url\").val(responseJSON.filename);
                }",
                    'onProgress'=>"js:function(id, fileName, loaded,total){}",
                ),
                'template' => '<div class="qq-uploader span12">'
                    .'<div class="qq-upload-button btn btn-success">upload story zip</div>'
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
		<?php echo $form->labelEx($model,'rec_status'); ?>
		<?php echo $form->DropDownList($model,'rec_status',array('A'=>'激活','D'=>'不激活')); ?>
		<?php echo $form->error($model,'rec_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->