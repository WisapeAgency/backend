<?php
/* @var $this SendMessageController */
/* @var $model SendMessage */

$this->breadcrumbs=array(
	'Send Messages'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SendMessage', 'url'=>array('index')),
	array('label'=>'Create SendMessage', 'url'=>array('create')),
	array('label'=>'Update SendMessage', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SendMessage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SendMessage', 'url'=>array('admin')),
);
?>

<h1>View SendMessage #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_email',
		'title',
		'subject',
		'user_message',
		'parsetime',
	),
)); ?>
