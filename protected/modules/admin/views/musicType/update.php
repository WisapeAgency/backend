<?php
/* @var $this MusicTypeController */
/* @var $model MusicType */

$this->breadcrumbs=array(
	'Music Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MusicType', 'url'=>array('index')),
	array('label'=>'Create MusicType', 'url'=>array('create')),
	array('label'=>'View MusicType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MusicType', 'url'=>array('admin')),
);
?>

<h1>Update MusicType <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>