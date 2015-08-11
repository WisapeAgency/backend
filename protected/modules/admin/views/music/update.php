<?php
/* @var $this MusicController */
/* @var $model Music */

$this->breadcrumbs=array(
	'Musics'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Music', 'url'=>array('index')),
	array('label'=>'Create Music', 'url'=>array('create')),
	array('label'=>'View Music', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Music', 'url'=>array('admin')),
);
?>

<h1>Update Music <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>