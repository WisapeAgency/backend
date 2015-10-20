<?php
/* @var $this MusicController */
/* @var $model Music */

$this->breadcrumbs=array(
	'Musics'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Music', 'url'=>array('index')),
	array('label'=>'Create Music', 'url'=>array('create')),
	array('label'=>'Update Music', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Music', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Music', 'url'=>array('admin')),
);
?>

<h1>View Music #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'music_name',
		'music_url',
		'type',
		'rec_status',
		'hash_code'
	),
)); ?>
