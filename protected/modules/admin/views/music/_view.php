<?php
/* @var $this MusicController */
/* @var $data Music */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('music_name')); ?>:</b>
	<?php echo CHtml::encode($data->music_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('music_url')); ?>:</b>
	<?php echo CHtml::encode($data->music_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rec_status')); ?>:</b>
	<?php echo CHtml::encode($data->rec_status); ?>
	<br />


</div>