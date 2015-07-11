<?php
/* @var $this TemplateController */
/* @var $model Template */

$this->breadcrumbs=array(
	'Templates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Template', 'url'=>array('index')),
	array('label'=>'Manage Template', 'url'=>array('admin')),
);
?>

<h1>Create Template</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>