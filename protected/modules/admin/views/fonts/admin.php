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
		array(
				'htmlOptions'=>array('width'=>"30px"),
				'class' => 'CCheckBoxColumn',
				'name'=>'id',
				'value'=>'$data->id',
				'id'=>'ids',
				'headerTemplate'=>'{item}',
				'selectableRows'=>2,
		),
		'id',
		'name',
		array(
            'name'=>'rec_status',
            'header'=>'status',
            'filter'=>CHtml::dropDownList('Fonts[rec_status]', $model->rec_status, array(''=>'请选择','A'=>'激活','D'=>'未激活')),
            'value'=> '$data->rec_status=="A" ? "激活":"未激活"',
        ),
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
<div class="row buttons">
    <script type="text/javascript">
        var data = new Object();  //对象
        data.YII_CSRF_TOKEN='<?php echo Yii::app()->getRequest()->getCsrfToken() ?>';
        function submitAjax(state){
            data.state = state;   //为对象添加state属性，属性值为state  等同于：data['state'] = state
            data.checkedValue=$('#fonts-grid').yiiGridView('getChecked', 'ids');
            if (data.checkedValue.length==0){
                alert("至少选择一项");
                return;
            }
            url = '<?php echo SITE_URL?>/index.php/admin/fonts/status';
//            $.each(data,function(key,val){
//                alert('data数组中,索引:'+key+'对应的值为:'+val);
//            });
            $.ajax({
                url: url,
                type:'get',//必须使用,不知道为什么
                dataType:'json',
                data:data,
                success:function(data){
                    jQuery('#fonts-grid').yiiGridView('update');
                }
            })
        }

    </script>
    <?php echo CHtml::button("激活",array('onClick'=>'submitAjax("A");')); ?>
    <?php echo CHtml::button("禁用",array('onClick'=>'submitAjax("D");')); ?>
</div>