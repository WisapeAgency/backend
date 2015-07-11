<?php
/* @var $this TemplateController */
/* @var $model Template */
/* @var $form CActiveForm */
?>

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
		<?php echo $form->textField($model,'temp_img',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'temp_img'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'temp_description'); ?>
		<?php echo $form->textArea($model,'temp_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'temp_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'temp_url'); ?>
		<?php echo $form->textField($model,'temp_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'temp_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rec_status'); ?>
		<?php echo $form->textField($model,'rec_status',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'rec_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->