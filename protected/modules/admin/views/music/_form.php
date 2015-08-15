<?php
/* @var $this MusicController */
/* @var $model Music */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'music-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'music_name'); ?>
		<?php echo $form->textField($model,'music_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'music_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'music_url'); ?>
		<?php echo $form->textField($model,'music_url',array('size'=>60,'maxlength'=>255,'id'=>'music_url')); ?>
		<?php echo $form->error($model,'music_url'); ?>
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
                    $(\"#music_url\").val(responseJSON.filename);
                }",
                    'onProgress'=>"js:function(id, fileName, loaded,total){}",
                ),
                'template' => '<div class="qq-uploader span12">'
                    .'<div class="qq-upload-button btn btn-success">upload mp3 file</div>'
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
        <?php echo $form->DropDownList($model,'type',CHtml::listData(MusicType::model()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model,'type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'rec_status'); ?>
        <?php echo $form->DropDownList($model,'rec_status',array(''=>'请选择','A'=>'激活','D'=>'不激活'.PAGE_SIZE)); ?>
        <?php echo $form->error($model,'rec_status'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->