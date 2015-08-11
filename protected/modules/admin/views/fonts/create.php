<?php
/* @var $this FontsController */
/* @var $model Fonts */

$this->breadcrumbs=array(
	'Fonts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Fonts', 'url'=>array('index')),
	array('label'=>'Manage Fonts', 'url'=>array('admin')),
);
?>

<h1>Create Fonts</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>