<?php
/* @var $this ActiveController */
/* @var $model Active */

$this->breadcrumbs=array(
	'Actives'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Active', 'url'=>array('index')),
	array('label'=>'Create Active', 'url'=>array('create')),
	array('label'=>'View Active', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Active', 'url'=>array('admin')),
);
?>

<h1>Update Active <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>