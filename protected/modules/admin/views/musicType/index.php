<?php
/* @var $this MusicTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Music Types',
);

$this->menu=array(
	array('label'=>'Create MusicType', 'url'=>array('create')),
	array('label'=>'Manage MusicType', 'url'=>array('admin')),
);
?>

<h1>Music Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
