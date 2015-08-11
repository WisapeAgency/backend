<?php
/* @var $this ActiveController */
/* @var $model Active */

$this->breadcrumbs=array(
	'Actives'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Active', 'url'=>array('index')),
	array('label'=>'Manage Active', 'url'=>array('admin')),
);
?>

<h1>Create Active</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>