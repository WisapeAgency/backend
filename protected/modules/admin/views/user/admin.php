<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>

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
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'user_id',
		'nick_name',
		'user_email',
		'access_token',
		'install_id',
		array(
				'name'=>'user_ico_n',
				'type'=>'raw',
				'value'=>'CHtml::image($data->user_ico_n,"",array("style"=>"width:100px;height:125px;"))',
		),
		/*
		'user_pwd',
		'user_ext',
		'user_ext_name',
		'user_sex',
		'user_ico_n',
		'user_ico_b',
		'user_ico_s',
		'user_token_id',
		'user_back_img',
		'unique_str',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
