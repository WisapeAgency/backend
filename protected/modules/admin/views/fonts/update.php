<?php
/* @var $this FontsController */
/* @var $model Fonts */

$this->breadcrumbs=array(
	'Fonts'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Fonts', 'url'=>array('index')),
	array('label'=>'Create Fonts', 'url'=>array('create')),
	array('label'=>'View Fonts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Fonts', 'url'=>array('admin')),
);
?>

<h1>Update Fonts <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>