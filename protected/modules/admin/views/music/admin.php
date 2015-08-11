<?php
/* @var $this MusicController */
/* @var $model Music */

$this->breadcrumbs=array(
	'Musics'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Music', 'url'=>array('index')),
	array('label'=>'Create Music', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#music-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Musics</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'music-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'music_name',
//		'music_url',
        array(
            'name'=>'type',
            'filter'=>CHtml::listData( MusicType::model()->findAll(), 'id', 'name'),
            'value'=>'$data->typeName->name'
        ),
        array(
            'name'=>'rec_status',
            'header'=>'status',
            'filter'=>CHtml::dropDownList('Music[rec_status]', $model->rec_status, array(''=>'请选择','A'=>'活动','D'=>'非活动')),
            'value'=> '$data->rec_status=="A" ? "活动":"非活动"',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
