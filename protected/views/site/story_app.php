<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>

<!-- 移动设备支持 -->
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
<meta content="no-cache" http-equiv="pragma">
<meta content="0" http-equiv="expires">
<meta content="telephone=no, address=no" name="format-detection">
<meta name="apple-mobile-web-app-capable" content="yes"> 
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

<link href="<?php echo SITE_URL?>custom/css/reset-static.css" rel="stylesheet" type="text/css">
<link href="<?php echo SITE_URL?>custom/css/mod-static.css" rel="stylesheet" type="text/css">
<link href="<?php echo SITE_URL?>custom/css/reset.css" rel="stylesheet" type="text/css">
<link href="<?php echo SITE_URL?>custom/css/animation.css" rel="stylesheet" type="text/css">
<link href="<?php echo SITE_URL?>uploads/fonts/fonts.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo SITE_URL?>custom/js/jquery-1.8.2.min.js"></script>
<style>
footer {display:block; position:fixed; bottom:0; width:100%; line-height:2.5;  color:#fff; font-size:12px; text-align:center; background-color:#333; z-index:100; opacity:0.6}
footer a { color:white; }
</style>
</head>
<body>
<script>
var gd = true;//true:无限滚动，false:到最后页不能再滚
</script>
  <div class="p-index main" id="con"> 
   <!--上下滚动 start-->
    <?php echo $content?>
  	
    <section class="m-page hide" >
        <div class="m-img" >
	    	<div class="sj_zh1">
	    		<div class="sj_zh1_tx">
	    			<img src="<?php echo empty($user->user_ico_n) ? SITE_URL.'custom/play-img/icon_menu_default_head.png' : $user->user_ico_n ?>" alt="">
	    		</div>
	    		<p class="sj_zh1_tx_p1">by <?php echo $user->nick_name?></p>
	    		<p class="sj_zh1_tx_p2">
	    			<a href="javascript:;" class="sj_zh1_tx_p2_a1"></a><!-- 点赞以后换成sj_zh1_tx_p2_a2即可 -->
	    			<span class="sj_zh1_tx_p2_psan1"><?php echo $story->like_num?></span>
	    		</p>
	    	</div>
	    	<div class="sj_zh2">
	    		<p class="sj_zh2_p1">Free download Wisape</p>
	    		<p class="sj_zh2_p2">Telling your amazing story to the world</p>
	    		<p class="sj_zh2_p3">
	    			<a href="javascript:;" class="sj_zh2_p3_a1"></a>
	    		</p>
	    		<div class="sj_zh2_div1"></div>
	    	</div>
	    </div>
    </section>

    <section class='u-arrow'><img src="<?php echo SITE_URL?>custom/play-img/btn01_arrow.png" /></section>
    <!--上下滚动代码 end-->
</div>

<!--音乐-->
<?php if($story->bg_music){?>
<div id="audio-btn" class="on" onclick="lanren.changeClass(this,'media')">
	<audio loop="loop" src="<?php echo SITE_URL?>uploads/music/<?php echo $story->bg_music?>.mp3" id="media" preload="preload"></audio>
</div>
<?php }?>
<script>
	var lanren = {
		changeClass: function (target,id) {
	       	var className = $(target).attr('class');
	       	var ids = document.getElementById(id);
	       	(className == 'on')
	           	? $(target).removeClass('on').addClass('off')
	           	: $(target).removeClass('off').addClass('on');
	       	(className == 'on')
	           	? ids.pause()
	           	: ids.play();
	   	},
		play:function(){
			document.getElementById('media').play();
		}
	}
	lanren.play();
<!--代码部分end-->

	//更新浏览数量
	$(function(){
		var url = '<?php echo SITE_URL?>index.php/v1/story/share';
		$.get(url, {type:'2', sid:'<?php echo $story->id?>'}, function(){
			//
		});
	});

	//点赞
	$('.sj_zh1_tx_p2 a').click(function(){
		var _this = $(this);
		var like_num_obj = _this.parent().find('span');
		var like_num;
		var opt = 'like';
		if(_this.is('.sj_zh1_tx_p2_a1')){
			_this.removeClass('sj_zh1_tx_p2_a1');
			_this.addClass('sj_zh1_tx_p2_a2');
			like_num = parseInt(like_num_obj.text()) + 1;
		}else{
			_this.removeClass('sj_zh1_tx_p2_a2');
			_this.addClass('sj_zh1_tx_p2_a1');
			like_num = parseInt(like_num_obj.text()) - 1;
			opt = 'unlike';
		}
		var url = '<?php echo SITE_URL?>index.php/v1/story/share';
		$.get(url, {type:'3', opt:opt, sid:'<?php echo $story->id?>'}, function(){
			like_num_obj.text(like_num);
		});
	});
</script>
<script type="text/javascript" src="<?php echo SITE_URL?>custom/js/jquery.easing.1.3.js"></script> 
<script type="text/javascript" src="<?php echo SITE_URL?>custom/js/page_scroll_bx.js"></script> 
</body>
</html>



