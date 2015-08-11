<?php
/* @var $this TemplateTypeController */
/* @var $model TemplateType */

$this->breadcrumbs=array(
	'Template Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TemplateType', 'url'=>array('index')),
	array('label'=>'Create TemplateType', 'url'=>array('create')),
	array('label'=>'View TemplateType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TemplateType', 'url'=>array('admin')),
);
?>

<h1>Update TemplateType <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>