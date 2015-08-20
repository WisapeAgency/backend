<?php
$this->breadcrumbs=array(
	'Story Officials'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StoryOfficial', 'url'=>array('index')),
	array('label'=>'Manage StoryOfficial', 'url'=>array('admin')),
);
?>

<h1>Create StoryOfficial</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>