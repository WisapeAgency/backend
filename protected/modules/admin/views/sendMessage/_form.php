<?php
/* @var $this SendMessageController */
/* @var $model SendMessage */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'send-message-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_email'); ?>
		<?php echo $form->textField($model,'user_email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'user_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_message'); ?>
		<?php echo $form->textArea($model,'user_message',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'user_message'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parsetime'); ?>
        <?php
        $this->widget('ext.my97DatePicker.JMy97DatePicker',array(
            'name'=>CHtml::activeName($model,'parsetime'),
            'value'=>$model->parsetime?$model->parsetime:'',
            'options'=>array('dateFmt'=>'yyyy-MM-dd HH:mm'),
        ));
        ?>
		<?php echo $form->error($model,'parsetime'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->