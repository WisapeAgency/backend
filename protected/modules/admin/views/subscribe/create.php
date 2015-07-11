<?php
/* @var $this SubscribeController */
/* @var $model Subscribe */

$this->breadcrumbs=array(
	'Subscribes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Subscribe', 'url'=>array('index')),
	array('label'=>'Manage Subscribe', 'url'=>array('admin')),
);
?>

<h1>Create Subscribe</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>