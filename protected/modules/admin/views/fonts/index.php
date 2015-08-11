<?php
/* @var $this FontsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fonts',
);

$this->menu=array(
	array('label'=>'Create Fonts', 'url'=>array('create')),
	array('label'=>'Manage Fonts', 'url'=>array('admin')),
);
?>

<h1>Fonts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
