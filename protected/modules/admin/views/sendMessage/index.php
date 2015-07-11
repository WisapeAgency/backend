<?php
/* @var $this SendMessageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Send Messages',
);

$this->menu=array(
	array('label'=>'Create SendMessage', 'url'=>array('create')),
	array('label'=>'Manage SendMessage', 'url'=>array('admin')),
);
?>

<h1>Send Messages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
