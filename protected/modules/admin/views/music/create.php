<?php
/* @var $this MusicController */
/* @var $model Music */

$this->breadcrumbs=array(
	'Musics'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Music', 'url'=>array('index')),
	array('label'=>'Manage Music', 'url'=>array('admin')),
);
?>

<h1>Create Music</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>