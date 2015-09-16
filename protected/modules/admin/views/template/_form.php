<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'template-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'temp_name'); ?>
		<?php echo $form->textField($model,'temp_name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'temp_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'temp_img'); ?>
		<?php echo $form->textField($model,'temp_img',array('size'=>60,'maxlength'=>255,'id'=>'temp_img','readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'temp_img'); ?>
        <img id="pre_bg" src="<?php echo $model->temp_img?$model->temp_img:SITE_URL.'uploads/nopic.jpg'?>" width="100px">
        <?php
        $this->widget('ext.EAjaxUpload.EAjaxUploadWidget', array(
            'id'=>CHtml::getIdByName('MyAjaxUpload'),
            'config'=>array(
                'request'=>array(
                    'endpoint'=>Yii::app()->createUrl('site/ajaxUpload'),
					'params'=>array('module'=>'template')
                ),
                'callbacks' => array(
                    'onComplete'=>"js:function(id, fileName, responseJSON){
                    $(\"#temp_img\").val(responseJSON.filename);
                    $(\"#pre_bg\").attr('src',responseJSON['filename']);
                }",
                    'onProgress'=>"js:function(id, fileName, loaded,total){}",
                ),
                'template' => '<div class="qq-uploader span12">'
                    .'<div class="qq-upload-button btn btn-success">{uploadButtonText}</div>'
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
		<?php echo $form->labelEx($model,'temp_description'); ?>
		<?php echo $form->textArea($model,'temp_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'temp_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'temp_url'); ?>
		<?php echo $form->textField($model,'temp_url',array('size'=>60,'maxlength'=>255,'id'=>'temp_url','readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'temp_url'); ?>

        <?php
        $this->widget('ext.EAjaxUpload.EAjaxUploadWidget', array(
            'id'=>CHtml::getIdByName('zipurl'),
            'config'=>array(
                'request'=>array(
                    'endpoint'=>Yii::app()->createUrl('site/ajaxUpload'),
					'params'=>array('module'=>'template'),
                    $allowedExtensions = array("zip")
                ),
                'callbacks' => array(
                    'onComplete'=>"js:function(id, fileName, responseJSON){
                    $(\"#temp_url\").val(responseJSON.filename);
                }",
                    'onProgress'=>"js:function(id, fileName, loaded,total){}",
                ),
                'template' => '<div class="qq-uploader span12">'
                    .'<div class="qq-upload-button btn btn-success">upload Zip file</div>'
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
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->DropDownList($model,'type',CHtml::listData(TemplateType::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order'); ?>
		<?php echo $form->textField($model,'order'); ?>
		<?php echo $form->error($model,'order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order_type'); ?>
		<?php echo $form->DropDownList($model,'order_type',array(''=>'请选择','N'=>'New','H'=>'Hot')); ?>
		<?php echo $form->error($model,'order_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'default_down'); ?>
		<?php echo $form->DropDownList($model,'default_down',array('0'=>'否','1'=>'是')); ?>
		<?php echo $form->error($model,'default_down'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
<!-- form -->