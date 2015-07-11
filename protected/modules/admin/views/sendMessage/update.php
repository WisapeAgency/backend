<?php
/* @var $this SendMessageController */
/* @var $model SendMessage */

$this->breadcrumbs=array(
	'Send Messages'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SendMessage', 'url'=>array('index')),
	array('label'=>'Create SendMessage', 'url'=>array('create')),
	array('label'=>'View SendMessage', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SendMessage', 'url'=>array('admin')),
);
?>

<h1>Update SendMessage <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>