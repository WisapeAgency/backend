<?php
$this->breadcrumbs=array(
	'Request People'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RequestPerson', 'url'=>array('index')),
	array('label'=>'Create RequestPerson', 'url'=>array('create')),
	array('label'=>'View RequestPerson', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RequestPerson', 'url'=>array('admin')),
);
?>

<h1>Update RequestPerson <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>