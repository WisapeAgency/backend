<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nick_name'); ?>
		<?php echo $form->textField($model,'nick_name'); ?>
		<?php echo $form->error($model,'nick_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_pwd'); ?>
		<?php echo $form->textField($model,'user_pwd',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'user_pwd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_email'); ?>
		<?php echo $form->textField($model,'user_email',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'user_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_ext'); ?>
		<?php echo $form->textField($model,'user_ext',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'user_ext'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_ext_name'); ?>
		<?php echo $form->textField($model,'user_ext_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'user_ext_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_sex'); ?>
		<?php echo $form->textField($model,'user_sex',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'user_sex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_ico_n'); ?>
		<?php echo $form->textField($model,'user_ico_n',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'user_ico_n'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_ico_b'); ?>
		<?php echo $form->textField($model,'user_ico_b',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'user_ico_b'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_ico_s'); ?>
		<?php echo $form->textField($model,'user_ico_s',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'user_ico_s'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_token_id'); ?>
		<?php echo $form->textField($model,'user_token_id'); ?>
		<?php echo $form->error($model,'user_token_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'access_token'); ?>
		<?php echo $form->textField($model,'access_token',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'access_token'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_back_img'); ?>
		<?php echo $form->textField($model,'user_back_img',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'user_back_img'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unique_str'); ?>
		<?php echo $form->textField($model,'unique_str',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'unique_str'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->