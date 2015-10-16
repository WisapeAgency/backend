<?php
/* @var $this MusicTypeController */
/* @var $model MusicType */

$this->breadcrumbs=array(
	'Music Types'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MusicType', 'url'=>array('index')),
	array('label'=>'Create MusicType', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#music-type-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Music Types</h1>

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
	'id'=>'music-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		array(
			'class'=>'CButtonColumn',
			'deleteConfirmation'=>"js:'你确定要删除【'+$(this).parent().parent().find('td:eq(1)').html()+'】吗？（该分类下的所有音乐也会被删除）'"
		),
	),
)); ?>
