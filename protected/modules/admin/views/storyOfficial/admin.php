<?php
$this->breadcrumbs=array(
	'Story Officials'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List StoryOfficial', 'url'=>array('index')),
	array('label'=>'Create StoryOfficial', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#story-official-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Story Officials</h1>

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
	'id'=>'story-official-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'story_name',
		array(
				'name'=>'small_img',
				'type'=>'raw',
				'value'=>'CHtml::image($data->small_img,"",array("style"=>"width:100px;height:125px;"))',
		),
		'rec_status',
		'createtime',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
