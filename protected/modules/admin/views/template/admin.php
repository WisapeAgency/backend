<?php
/* @var $this TemplateController */
/* @var $model Template */

$this->breadcrumbs=array(
	'Templates'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Template', 'url'=>array('index')),
	array('label'=>'Create Template', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#template-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Templates</h1>

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
	'id'=>'template-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'temp_name',
        array(
            'name'=>'temp_img',
            'type'=>'raw',
            'value'=>'CHtml::image($data->temp_img,"",array("style"=>"width:100px;height:125px;"))',
        ),
//        'temp_description',
//        'temp_url',
        array(
            'name'=>'rec_status',
            'header'=>'status',
            'filter'=>CHtml::dropDownList('Template[rec_status]', $model->rec_status, array(''=>'请选择','A'=>'激活','D'=>'未激活')),
            'value'=> '$data->rec_status=="A" ? "激活":"未激活"',
        ),
        array(
            'name'=>'type',
            'filter'=>CHtml::listData( TemplateType::model()->findAll(), 'id', 'name'),
//            'filter'=>CHtml::dropDownList('Template[type]', $model->type, Template::model()->findAllByAttributes('id','name')),
            'value'=>'$data->typeName->name'
        ),
        'order',
        array(
            'header'=>'HotNew',
            'name'=>'order_type',
            'filter'=>CHtml::dropDownList('Template[order_type]', $model->order_type, array(''=>'请选择','H'=>'Hot','N'=>'New')),
            'value'=>'$data->order_type=="H" ? "H":"N"'
        ),
		array(
				'header'=>'静默下载',
				'name'=>'default_down',
				'filter'=>CHtml::dropDownList('Template[default_down]', $model->default_down, array(''=>'请选择','0'=>'否','1'=>'是')),
				'value'=>'$data->default_down=="0" ? "否":"是"'
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
