<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('story_name')); ?>:</b>
	<?php echo CHtml::encode($data->story_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('story_url')); ?>:</b>
	<?php echo CHtml::encode($data->story_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bg_music')); ?>:</b>
	<?php echo CHtml::encode($data->bg_music); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('small_img')); ?>:</b>
	<?php echo CHtml::encode($data->small_img); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('rec_status')); ?>:</b>
	<?php echo CHtml::encode($data->rec_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('share_num')); ?>:</b>
	<?php echo CHtml::encode($data->share_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('like_num')); ?>:</b>
	<?php echo CHtml::encode($data->like_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('view_num')); ?>:</b>
	<?php echo CHtml::encode($data->view_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createtime')); ?>:</b>
	<?php echo CHtml::encode($data->createtime); ?>
	<br />

	*/ ?>

</div>