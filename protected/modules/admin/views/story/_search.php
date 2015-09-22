<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uid'); ?>
		<?php echo $form->textField($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'story_name'); ?>
		<?php echo $form->textField($model,'story_name',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'story_url'); ?>
		<?php echo $form->textField($model,'story_url',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bg_music'); ?>
		<?php echo $form->textField($model,'bg_music',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'small_img'); ?>
		<?php echo $form->textField($model,'small_img',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rec_status'); ?>
		<?php echo $form->textField($model,'rec_status',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'share_num'); ?>
		<?php echo $form->textField($model,'share_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'like_num'); ?>
		<?php echo $form->textField($model,'like_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'view_num'); ?>
		<?php echo $form->textField($model,'view_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'createtime'); ?>
		<?php echo $form->textField($model,'createtime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->