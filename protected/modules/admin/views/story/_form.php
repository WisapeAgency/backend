<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'story-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid'); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'story_name'); ?>
		<?php echo $form->textField($model,'story_name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'story_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'story_url'); ?>
		<?php echo $form->textField($model,'story_url',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'story_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bg_music'); ?>
		<?php echo $form->textField($model,'bg_music',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'bg_music'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'small_img'); ?>
		<?php echo $form->textField($model,'small_img',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'small_img'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rec_status'); ?>
		<?php echo $form->textField($model,'rec_status',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'rec_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'share_num'); ?>
		<?php echo $form->textField($model,'share_num'); ?>
		<?php echo $form->error($model,'share_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'like_num'); ?>
		<?php echo $form->textField($model,'like_num'); ?>
		<?php echo $form->error($model,'like_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'view_num'); ?>
		<?php echo $form->textField($model,'view_num'); ?>
		<?php echo $form->error($model,'view_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'createtime'); ?>
		<?php echo $form->textField($model,'createtime'); ?>
		<?php echo $form->error($model,'createtime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->