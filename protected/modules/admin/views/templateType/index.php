<?php
/* @var $this TemplateTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Template Types',
);

$this->menu=array(
	array('label'=>'Create TemplateType', 'url'=>array('create')),
	array('label'=>'Manage TemplateType', 'url'=>array('admin')),
);
?>

<h1>Template Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
