<?php
$this->breadcrumbs=array(
	'Stories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List story', 'url'=>array('index')),
	array('label'=>'Manage story', 'url'=>array('admin')),
);
?>

<h1>Create story</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>