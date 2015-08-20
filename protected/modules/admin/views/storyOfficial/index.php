<?php
$this->breadcrumbs=array(
	'Story Officials',
);

$this->menu=array(
	array('label'=>'Create StoryOfficial', 'url'=>array('create')),
	array('label'=>'Manage StoryOfficial', 'url'=>array('admin')),
);
?>

<h1>Story Officials</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
