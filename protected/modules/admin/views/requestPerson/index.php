<?php
$this->breadcrumbs=array(
	'Request People',
);

$this->menu=array(
	array('label'=>'Create RequestPerson', 'url'=>array('create')),
	array('label'=>'Manage RequestPerson', 'url'=>array('admin')),
);
?>

<h1>Request People</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
