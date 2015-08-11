<?php
/* @var $this MusicController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Musics',
);

$this->menu=array(
	array('label'=>'Create Music', 'url'=>array('create')),
	array('label'=>'Manage Music', 'url'=>array('admin')),
);
?>

<h1>Musics</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
