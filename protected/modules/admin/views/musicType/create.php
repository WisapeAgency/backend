<?php
/* @var $this MusicTypeController */
/* @var $model MusicType */

$this->breadcrumbs=array(
	'Music Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MusicType', 'url'=>array('index')),
	array('label'=>'Manage MusicType', 'url'=>array('admin')),
);
?>

<h1>Create MusicType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>