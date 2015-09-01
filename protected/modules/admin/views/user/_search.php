<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nick_name'); ?>
		<?php echo $form->textField($model,'nick_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_pwd'); ?>
		<?php echo $form->textField($model,'user_pwd',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_email'); ?>
		<?php echo $form->textField($model,'user_email',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_ext'); ?>
		<?php echo $form->textField($model,'user_ext',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_ext_name'); ?>
		<?php echo $form->textField($model,'user_ext_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_sex'); ?>
		<?php echo $form->textField($model,'user_sex',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_ico_n'); ?>
		<?php echo $form->textField($model,'user_ico_n',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_ico_b'); ?>
		<?php echo $form->textField($model,'user_ico_b',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_ico_s'); ?>
		<?php echo $form->textField($model,'user_ico_s',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_token_id'); ?>
		<?php echo $form->textField($model,'user_token_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'access_token'); ?>
		<?php echo $form->textField($model,'access_token',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_back_img'); ?>
		<?php echo $form->textField($model,'user_back_img',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'unique_str'); ?>
		<?php echo $form->textField($model,'unique_str',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->