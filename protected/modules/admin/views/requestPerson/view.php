<?php
$this->breadcrumbs=array(
	'Request People'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RequestPerson', 'url'=>array('index')),
	array('label'=>'Create RequestPerson', 'url'=>array('create')),
	array('label'=>'Update RequestPerson', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RequestPerson', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RequestPerson', 'url'=>array('admin')),
);
?>

<h1>View RequestPerson #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'req_type',
		'first_name',
		'last_name',
		'company_name',
		'country',
		'user_email',
		'message',
		'createtime',
		'download_count',
	),
)); ?>
