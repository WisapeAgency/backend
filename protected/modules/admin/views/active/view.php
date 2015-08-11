<?php
/* @var $this ActiveController */
/* @var $model Active */

$this->breadcrumbs=array(
	'Actives'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Active', 'url'=>array('index')),
	array('label'=>'Create Active', 'url'=>array('create')),
	array('label'=>'Update Active', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Active', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Active', 'url'=>array('admin')),
);
?>

<h1>View Active #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'bg_img',
		'url',
		'rec_status',
		'start_time',
		'end_time',
		'country',
	),
)); ?>
