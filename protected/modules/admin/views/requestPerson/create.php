<?php
$this->breadcrumbs=array(
	'Request People'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RequestPerson', 'url'=>array('index')),
	array('label'=>'Manage RequestPerson', 'url'=>array('admin')),
);
?>

<h1>Create RequestPerson</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>