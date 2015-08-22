<?php
/* @var $this ActiveController */
/* @var $model Active */

$this->breadcrumbs=array(
	'Actives'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Active', 'url'=>array('index')),
	array('label'=>'Create Active', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#active-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Actives</h1>

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
	'id'=>'active-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
        array(
            'name'=>'bg_img',
            'type'=>'raw',
            'value'=>'CHtml::image($data->bg_img,"",array("style"=>"width:100px;height:125px;"))',
        ),
        array(
            'name'=>'url',
            'type'=>'raw',
            'value'=>'CHtml::link("点击",$data->url,array("target"=>"_blank"))',

        ),
        array(
            'name'=>'rec_status',
            'header'=>'status',
            'filter'=>CHtml::dropDownList('Active[rec_status]', $model->rec_status, array(''=>'请选择','A'=>'激活','D'=>'未激活')),
            'value'=> '$data->rec_status=="A" ? "激活":"未激活"',
        ),
        array(
            'name'=>'start_time',
            'value'=>'$data->start_time',
        ),
        array(
            'name'=>'end_time',
            'value'=>'$data->end_time',
        ),
		'country',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
