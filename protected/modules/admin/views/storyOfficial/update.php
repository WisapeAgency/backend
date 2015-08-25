<?php
$this->breadcrumbs=array(
	'Story Officials'=>array('index'),
	$model->story_name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StoryOfficial', 'url'=>array('index')),
	array('label'=>'Create StoryOfficial', 'url'=>array('create')),
	array('label'=>'View StoryOfficial', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage StoryOfficial', 'url'=>array('admin')),
);
?>

<h1>Update StoryOfficial <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>