<?php
/* @var $this TemplateController */
/* @var $data Template */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temp_name')); ?>:</b>
	<?php echo CHtml::encode($data->temp_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temp_img')); ?>:</b>
	<?php echo CHtml::encode($data->temp_img); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temp_description')); ?>:</b>
	<?php echo CHtml::encode($data->temp_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temp_url')); ?>:</b>
	<?php echo CHtml::encode($data->temp_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rec_status')); ?>:</b>
	<?php echo CHtml::encode($data->rec_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('order')); ?>:</b>
	<?php echo CHtml::encode($data->order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_type')); ?>:</b>
	<?php echo CHtml::encode($data->order_type); ?>
	<br />

	*/ ?>

</div>