<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/application.min.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet">

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Le fav and touch icons -->
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-touch-icon-114x114.png">
</head>

<body>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="<?php echo $this->createAbsoluteUrl('//'); ?>"><?php echo CHtml::encode(Yii::app()->name); ?></a>
				<?php $this->widget('zii.widgets.CMenu',array(
					'items'=>array(
						array('label'=>'Home', 'url'=>array('/admin')),
						array('label'=>'Subscribe', 'url'=>array('/admin/Subscribe/admin')),
						array('label'=>'SendMessage', 'url'=>array('/admin/SendMessage/admin')),
                        array('label'=>'Template', 'url'=>array('/admin/Template/admin')),
                        array('label'=>'TemplateType', 'url'=>array('/admin/TemplateType/admin')),
                        array('label'=>'Music', 'url'=>array('/admin/Music/admin')),
                        array('label'=>'MusicType', 'url'=>array('/admin/MusicType/admin')),
                        array('label'=>'Fonts', 'url'=>array('/admin/Fonts/admin')),
                        array('label'=>'Active', 'url'=>array('/admin/Active/admin')),
						array('label'=>'Login', 'url'=>array('/admin/default/login'), 'visible'=>Yii::app()->user->isGuest),
					),
					'htmlOptions'=>array(
						'class'=>'nav',
					),
				)); ?>
				<?php $this->widget('zii.widgets.CMenu',array(
					'items'=>array(
						array('label'=>Yii::app()->user->name, 'url'=>array('site/profile'), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Logout', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest, 'htmlOptions'=>array('class'=>'btn'))
					),
					'htmlOptions'=>array(
						'class'=>'nav pull-right',
					),
				)); ?>
			</div>
		</div>
	</div>
	
	<div class="container">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('BBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
			'separator'=>' / ',
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	</div>
	
	<?php echo $content; ?>
	
	<footer class="footer">
		<div class="container">
			<p>Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
			All Rights Reserved.<br/>
			YileApp</p>
		</div>
	</footer>
	
</body>
</html>