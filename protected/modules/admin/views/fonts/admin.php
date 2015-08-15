<?php
/* @var $this FontsController */
/* @var $model Fonts */

$this->breadcrumbs=array(
	'Fonts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Fonts', 'url'=>array('index')),
	array('label'=>'Create Fonts', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#fonts-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Fonts</h1>

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
	'id'=>'fonts-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'zip_url',
		array(
				'header'=>'静默下载',
				'name'=>'default_down',
				'filter'=>CHtml::dropDownList('Fonts[default_down]', $model->default_down, array(''=>'请选择','0'=>'否','1'=>'是')),
				'value'=>'$data->default_down=="0" ? "否":"是"'
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
