<?php
/* @var $this FontsController */
/* @var $model Fonts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fonts-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<?php /**
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
**/?>

	<div class="row">
		<?php echo $form->labelEx($model,'preview_img'); ?>
		<?php echo $form->textField($model,'preview_img',array('size'=>60,'maxlength'=>200,'id'=>'preview_img','readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'preview_img'); ?>
		<img id="pre_bg" src="<?php echo $model->preview_img?>" width="100px">
        <?php
        $this->widget('ext.EAjaxUpload.EAjaxUploadWidget', array(
            'id'=>CHtml::getIdByName('previewimg'),
            'config'=>array(
                'request'=>array(
                    'endpoint'=>Yii::app()->createUrl('site/ajaxUpload'),
                	'params'=>array('module'=>'fonts/preview_image', 'uniqName'=>'0', 'file_type'=>'jpg,png,jpeg,bmp')
                ),
            	'validation'=> array(
            			'allowedExtensions'=>array('jpg','png','jpeg','bmp'),
            			'sizeLimit'=> 2*1024*1024
            	),
                'callbacks' => array(
                    'onComplete'=>"js:function(id, fileName, responseJSON){
                    $(\"#preview_img\").val(responseJSON.filename);
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
		<?php echo $form->labelEx($model,'zip_url'); ?>
		<?php echo $form->textField($model,'zip_url',array('size'=>60,'maxlength'=>200,'id'=>'zip_url','readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'zip_url'); ?>
        <?php
        $this->widget('ext.EAjaxUpload.EAjaxUploadWidget', array(
            'id'=>CHtml::getIdByName('zipurl'),
            'config'=>array(
                'request'=>array(
                    'endpoint'=>Yii::app()->createUrl('site/ajaxUpload'),
                	'params'=>array('module'=>'fonts', 'uniqName'=>'0', 'file_type'=>'zip')
                ),
				'validation'=> array(
						'allowedExtensions'=>array('zip'),
						'sizeLimit'=> 2*1024*1024
				),
                'callbacks' => array(
                    'onComplete'=>"js:function(id, fileName, responseJSON){
                    $(\"#zip_url\").val(responseJSON.filename);
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
<?php /**
	<div class="row">
		<?php echo $form->labelEx($model,'default_down'); ?>
		<?php echo $form->DropDownList($model,'default_down',array('0'=>'否','1'=>'是')); ?>
		<?php echo $form->error($model,'default_down'); ?>
	</div>
**/?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->