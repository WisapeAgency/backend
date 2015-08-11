<?php
/* @var $this TemplateTypeController */
/* @var $model TemplateType */

$this->breadcrumbs=array(
	'Template Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TemplateType', 'url'=>array('index')),
	array('label'=>'Manage TemplateType', 'url'=>array('admin')),
);
?>

<h1>Create TemplateType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>