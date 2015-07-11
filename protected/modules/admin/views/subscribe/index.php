<?php
/* @var $this SubscribeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Subscribes',
);

$this->menu=array(
	array('label'=>'Create Subscribe', 'url'=>array('create')),
	array('label'=>'Manage Subscribe', 'url'=>array('admin')),
);
?>

<h1>Subscribes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
