<?php
/* @var $this MusicTypeController */
/* @var $model MusicType */

$this->breadcrumbs=array(
	'Music Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List MusicType', 'url'=>array('index')),
	array('label'=>'Create MusicType', 'url'=>array('create')),
	array('label'=>'Update MusicType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MusicType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MusicType', 'url'=>array('admin')),
);
?>

<h1>View MusicType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
