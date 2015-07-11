<?php
/* @var $this SubscribeController */
/* @var $model Subscribe */

$this->breadcrumbs=array(
	'Subscribes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Subscribe', 'url'=>array('index')),
	array('label'=>'Create Subscribe', 'url'=>array('create')),
	array('label'=>'View Subscribe', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Subscribe', 'url'=>array('admin')),
);
?>

<h1>Update Subscribe <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>