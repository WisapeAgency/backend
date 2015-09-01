<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_id), array('view', 'id'=>$data->user_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nick_name')); ?>:</b>
	<?php echo CHtml::encode($data->nick_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_pwd')); ?>:</b>
	<?php echo CHtml::encode($data->user_pwd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_email')); ?>:</b>
	<?php echo CHtml::encode($data->user_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_ext')); ?>:</b>
	<?php echo CHtml::encode($data->user_ext); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_ext_name')); ?>:</b>
	<?php echo CHtml::encode($data->user_ext_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_sex')); ?>:</b>
	<?php echo CHtml::encode($data->user_sex); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_ico_n')); ?>:</b>
	<?php echo CHtml::encode($data->user_ico_n); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_ico_b')); ?>:</b>
	<?php echo CHtml::encode($data->user_ico_b); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_ico_s')); ?>:</b>
	<?php echo CHtml::encode($data->user_ico_s); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_token_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_token_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('access_token')); ?>:</b>
	<?php echo CHtml::encode($data->access_token); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_back_img')); ?>:</b>
	<?php echo CHtml::encode($data->user_back_img); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unique_str')); ?>:</b>
	<?php echo CHtml::encode($data->unique_str); ?>
	<br />

	*/ ?>

</div>