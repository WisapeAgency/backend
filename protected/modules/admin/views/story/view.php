<?php
$this->breadcrumbs=array(
	'Stories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List story', 'url'=>array('index')),
	array('label'=>'Create story', 'url'=>array('create')),
	array('label'=>'Update story', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete story', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage story', 'url'=>array('admin')),
);
?>

<h1>View story #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'story_name',
		'story_url',
		'description',
		'bg_music',
		'small_img',
		'rec_status',
		'share_num',
		'like_num',
		'view_num',
		'createtime',
	),
)); ?>
