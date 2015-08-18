<?php
/* @var $this SendMessageController */
/* @var $data SendMessage */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_email')); ?>:</b>
	<?php echo CHtml::encode($data->user_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject')); ?>:</b>
	<?php echo CHtml::encode($data->subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_message')); ?>:</b>
	<?php echo CHtml::encode($data->user_message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parsetime')); ?>:</b>
	<?php echo CHtml::encode($data->parsetime); ?>
	<br />


</div>