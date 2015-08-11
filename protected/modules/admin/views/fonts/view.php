<?php
/* @var $this FontsController */
/* @var $model Fonts */

$this->breadcrumbs=array(
	'Fonts'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Fonts', 'url'=>array('index')),
	array('label'=>'Create Fonts', 'url'=>array('create')),
	array('label'=>'Update Fonts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Fonts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Fonts', 'url'=>array('admin')),
);
?>

<h1>View Fonts #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'zip_url',
	),
)); ?>
