<?php
/* @var $this ActiveController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Actives',
);

$this->menu=array(
	array('label'=>'Create Active', 'url'=>array('create')),
	array('label'=>'Manage Active', 'url'=>array('admin')),
);
?>

<h1>Actives</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
