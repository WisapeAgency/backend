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

	<?php echo $form->errorSummary($model); ?>
<?php /**
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
**/?>

	<div class="row">
		<?php echo $form->labelEx($model,'app file'); ?>
		<?php echo $form->textField($model,'preview_img',array('size'=>60,'maxlength'=>200,'id'=>'preview_img','readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'preview_img'); ?>
        <?php
        $this->widget('ext.EAjaxUpload.EAjaxUploadWidget', array(
            'id'=>CHtml::getIdByName('previewimg'),
            'config'=>array(
                'request'=>array(
                    'endpoint'=>Yii::app()->createUrl('site/ajaxUpload'),
                	'params'=>array('module'=>'app', 'uniqName'=>'0')
                ),
                'callbacks' => array(
                    'onComplete'=>"js:function(id, fileName, responseJSON){
                    $(\"#preview_img\").val(responseJSON.filename);
                }",
                    'onProgress'=>"js:function(id, fileName, loaded,total){}",
                ),
                'template' => '<div class="qq-uploader span12">'
                    .'<div class="qq-upload-button btn btn-success">Upload App</div>'
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

<?php $this->endWidget(); ?>

</div><!-- form -->