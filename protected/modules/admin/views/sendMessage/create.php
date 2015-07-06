<?php
/* @var $this SendMessageController */
/* @var $model SendMessage */

$this->breadcrumbs=array(
	'Send Messages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SendMessage', 'url'=>array('index')),
	array('label'=>'Manage SendMessage', 'url'=>array('admin')),
);
?>

<h1>Create SendMessage</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>