<?php
$this->breadcrumbs=array(
	'Stories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List story', 'url'=>array('index')),
	array('label'=>'Create story', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#story-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Stories</h1>

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
	'id'=>'story-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
            'name'=>'uid',
            'filter'=>CHtml::listData( User::model()->findAll(), 'user_id', 'user_email'),
//             'filter'=>CHtml::textField('Story[user][user_email]'),
            'value'=>'$data->user->user_email'
        ),
		'story_name',
		'like_num',
		'view_num',
		'bg_music',
		array(
            'name'=>'rec_status',
            'header'=>'status',
            'filter'=>CHtml::dropDownList('Story[rec_status]', $model->rec_status, array(''=>'请选择','A'=>'正常','B'=>'默认' ,'D'=>'已删除')),
            'value'=> '$data->rec_status=="A" ? "正常":($data->rec_status=="B" ? "默认": "已删除")',
        ),
		/*
		'share_num',
		'story_url',
		'bg_music',
		'description',
		'small_img',
		'createtime',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
