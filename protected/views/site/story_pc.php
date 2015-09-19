<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<link href="<?php echo SITE_URL?>custom/css/eqShow-5.0.1.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SITE_URL?>custom/css/pcviewer.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SITE_URL?>custom/css/reset-static.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SITE_URL?>custom/css/mod-static.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SITE_URL?>custom/css/reset.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SITE_URL?>custom/css/animation.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SITE_URL?>uploads/fonts/fonts.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="<?php echo SITE_URL?>custom/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL?>custom/js/wxsharejs.js"></script>
</head>
<body>
<div class="logo">
    <a href="index.html"><img src="<?php echo SITE_URL?>custom/play-img/logo.png" alt=""/></a>
</div>
<div class="phone_panel">
	<div class="phoneBox">
		<div class="nr" id="nr">
			<!-- <iframe src="./zhaoshang/phone.html" width="485px" height="749px" class="iframe"></iframe> -->
			<script>
				var gd = true;//true:无限滚动，false:到最后页不能再滚
			</script>
			<div class="" id="con"> 
		   <!--上下滚动 start-->
				<?php echo $content?>
			    <section class="m-page hide" >
			        <div class="m-img" >
				    	<div class="sj_zh1">
				    		<div class="sj_zh1_tx">
				    			<img src="./<?php echo SITE_URL?>custom/play-img/tx.jpg" alt="">
				    		</div>
				    		<p class="sj_zh1_tx_p1">by <?php echo $user->nick_name?></p>
				    		<p class="sj_zh1_tx_p2">
				    			<a href="javascript:;" class="sj_zh1_tx_p2_a1"></a><!-- 点赞以后换成sj_zh1_tx_p2_a2即可 -->
				    			<span class="sj_zh1_tx_p2_psan1"><?php echo $like_num?></span>
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
			    <!--音乐-->
				<div id="audio-btn" class="on" onclick="lanren.changeClass(this,'media')">
					<audio loop="loop" src="<?php echo SITE_URL?>uploads/music/<?php echo $bg_music?>.mp3" id="media" preload="preload"></audio>
				</div>
			</div>
        </div>
	</div>
	<div class="ctrl_panel">
		<a id="pre_page" type="button" class="pre_btn btn" onclick="prePage()"></a>
		<a id="next_page" type="button" class="next_btn btn" onclick="nextPage()"></a>

	</div>
	<div id="code">
		<h1 class="code_h1"><span class="code_span1">B</span>usness card</h1>
		<p class="code_p1">Look at the following contrast figure,you will find that,no friends an ugly too handsome to look</p>
		<p class="code_p2">Scan QR Code to share this story</p>
		<div style="text-align: center;background:#fff;padding: 10px;" id="codeImg">
			<img width="200" height="200" src="<?php echo $qr_url?>">
		</div>
		<p class="code_p3">Or</p>
		 <!-- AddToAny BEGIN -->
		<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
		<a class="a2a_button_facebook"></a>
		<a class="a2a_button_twitter"></a>
		<a class="a2a_button_linkedin"></a>
		<a class="a2a_button_google_plus"></a>
		<a class="a2a_dd" href="https://www.addtoany.com/share_save"></a>
		</div>
		<script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
		<!-- AddToAny END -->
		<div class="code_div1">
			<p class="code_div1_p"><span class="code_div1_p_span1">Create and Share</span><br/><span class="code_div1_p_span2">your stunning story atound the world</span></p>
		</div>
		<p class="code_p5">
			<a href="#" class="code_p5_a"></a>
			<a href="#" class="code_p5_a code_p5_a2"></a>
		</p>
	</div>
</div>
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
		$.get(url, {type:'3', opt:opt, sid:'<?php echo $sid?>'}, function(){
			like_num_obj.text(like_num);
		});
	});
</script>
<script type="text/javascript" src="<?php echo SITE_URL?>custom/js/jquery.easing.1.3.js"></script> 
<script type="text/javascript" src="<?php echo SITE_URL?>custom/js/page_scroll_bx.js"></script> 
</body>
</html>