<?php
$this->breadcrumbs=array(
	'Stories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List story', 'url'=>array('index')),
	array('label'=>'Create story', 'url'=>array('create')),
	array('label'=>'View story', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage story', 'url'=>array('admin')),
);
?>

<h1>Update story <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>