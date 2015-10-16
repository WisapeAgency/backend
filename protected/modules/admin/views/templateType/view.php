<?php
/* @var $this TemplateTypeController */
/* @var $model TemplateType */

$this->breadcrumbs=array(
	'Template Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List TemplateType', 'url'=>array('index')),
	array('label'=>'Create TemplateType', 'url'=>array('create')),
	array('label'=>'Update TemplateType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TemplateType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'你确定要删除【'.$model->name.'】吗？（该分类下的所有模板也会被删除）')),
	array('label'=>'Manage TemplateType', 'url'=>array('admin')),
);
?>

<h1>View TemplateType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
