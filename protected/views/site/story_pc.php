<!DOCTYPE html>
<html lang="en" style="font-size:20px;">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<link href="<?php echo SITE_URL?>custom/css/reset-static.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SITE_URL?>custom/css/mod-static.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SITE_URL?>custom/css/reset.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SITE_URL?>custom/css/animation.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SITE_URL?>uploads/fonts/fonts.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL?>custom/css/eqShow-5.0.13.css">
	<script type="text/javascript" src="<?php echo SITE_URL?>custom/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL?>custom/js/wxsharejs.js"></script>
	<script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
	<style type="text/css">
		.code_p4_a span{
			background-image:none!important;
		}
	</style>
</head>
<body>
<div id="mask" style="width: 100%; height: 100%; z-index: 9999; position: absolute; top: 0px; left: 0px; background: white url(<?php echo SITE_URL?>custom/play-img/loading.gif) no-repeat center center;" >
</div>
<div class="pc-box">
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
				    			<a href="http://fir.im/wisape" class="sj_zh2_p3_a1"></a>
				    		</p>
				    		<div class="sj_zh2_div1"></div>
				    	</div>
				    </div>
			    </section>

			    <section class='u-arrow'><img src="<?php echo SITE_URL?>custom/play-img/btn01_arrow.png" /></section>
			    <!--上下滚动代码 end-->
			    <!--音乐-->
			    <?php if($story->bg_music){?>
				<div id="audio-btn" class="on" onclick="lanren.changeClass(this,'media')">
					<audio loop="loop" src="<?php echo SITE_URL?>uploads/music/<?php echo $story->bg_music?>.mp3" id="media" preload="preload"></audio>
				</div>
				<?php }?>
			</div>
        </div>
	</div>
	<div class="ctrl_panel">
		<a id="pre_page" type="button" class="pre_btn btn" onclick="changePage(true)"></a>
		<a id="next_page" type="button" class="next_btn btn" onclick="changePage(false)"></a>

	</div>
	<div id="code">
		<h1 class="code_h1"><?php echo $story->story_name?></h1>
		<p class="code_p1"><?php echo $story->description?></p>
		<p class="code_p2">Share the story:</p>
		<div id="codeImg">
			<img width="200" height="200" src="<?php echo $qr_url?>">
		</div>
		 <!-- AddToAny BEGIN -->
		<p class="a2a_kit code_p4">
			<a href="#" class="a2a_button_facebook code_p4_a code_p4_a1"></a>
			<a href="#" class="a2a_button_twitter code_p4_a code_p4_a2"></a>
			<a href="#" class="a2a_button_linkedin code_p4_a code_p4_a3"></a>
			<a href="#" class="a2a_button_google_plus code_p4_a code_p4_a4"></a>
			<a href="#" class="copy_link code_p4_a code_p4_a5"></a>
		</p>
		<!--
		<div class="a2a_kit a2a_kit_size_32 a2a_default_style code_p4">
			<a class="a2a_button_facebook code_p4_a code_p4_a1"></a>
			<a class="a2a_button_twitter code_p4_a code_p4_a2"></a>
			<a class="a2a_button_linkedin code_p4_a code_p4_a3"></a>
			<a class="a2a_button_google_plus code_p4_a code_p4_a4"></a>
			<a class="a2a_dd code_p4_a code_p4_a5" href="https://www.addtoany.com/share_save"></a>
		</div>
		-->
		<!-- AddToAny END -->
		<div class="code_div1">
			<p class="code_div1_p"><span class="code_div1_p_span1">Create and Share</span><br/><span class="code_div1_p_span2">your stunning story atound the world</span></p>
		</div>
		<p class="code_p5">
			<a href="#" class="code_p5_a code_p5_a1"></a>
			<a href="#" class="code_p5_a code_p5_a2"></a>
		</p>
		<div class="img5">Copyright @2015 Wisape all rights reserved</div>
	</div>
</div>
</div>
</body>
<script type="text/javascript" src="<?php echo SITE_URL?>custom/js/jquery.easing.1.3.js"></script> 
<script type="text/javascript" src="<?php echo SITE_URL?>custom/js/page_scroll_bx.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL?>custom/js/turn-page.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL?>custom/js/jquery.zclip.min.js"></script>
<script>
	//拷贝当前链接
	$(document).ready(function(){
		/* 定义所有class为copy标签，点击后可复制被点击对象的文本 */
	    $(".copy_link").zclip({
	        path: "<?php echo SITE_URL?>custom/js/ZeroClipboard.swf",
	        copy: function(){
	        	return '<?php echo SITE_URL?>index.php/site/story/id/<?php echo $story->id?>';
	        }
	    });
	    $(".copy_link").hover(
	    	 function(){
				$(this).addClass('code_p4_a5_hover');
	    	 },
	    	 function(){
	    		 $(this).removeClass('code_p4_a5_hover');
	    	 }  
    	);

    	$('div.font-link').click(function(){
        	window.location.href = $(this).attr('data-href');
        });
	});
	//
	$(document).ready(function(){
		//alert($(".nr").height());//打印
		var gd=($(document.body).height());
		$("body").height(gd);
	});
	window.onresize=function(){ 
		var gd=($(document.body).height());
		$("body").height(gd);
	};
	//播放音乐
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
			var media = document.getElementById('media');
			if(media != undefined){
				media.play();
			}
		}
	}
	lanren.play();

	//更新浏览数量
	$(function(){
		var url = '<?php echo SITE_URL?>index.php/v1/story/share';
		$.get(url, {type:'2', sid:'<?php echo $story->id?>'}, function(){
			//
		});
	});

	//点赞
	var executing = false;
	$('.sj_zh1_tx_p2 a').click(function(){
		if(executing){
			return;
		}
		executing = true;
		var _this = $(this);
		var like_num_obj = _this.parent().find('span');
		var is_like = _this.is('.sj_zh1_tx_p2_a1');
		var opt = is_like ? 'like' : 'unlike';
		var url = '<?php echo SITE_URL?>index.php/v1/story/share';
		$.get(url, {type:'3', opt:opt, sid:'<?php echo $story->id?>'}, function(){
			var like_num;
			if(is_like){
				_this.removeClass('sj_zh1_tx_p2_a1');
				_this.addClass('sj_zh1_tx_p2_a2');
				like_num = parseInt(like_num_obj.text()) + 1;
			}else{
				_this.removeClass('sj_zh1_tx_p2_a2');
				_this.addClass('sj_zh1_tx_p2_a1');
				like_num = parseInt(like_num_obj.text()) - 1;
			}
			like_num_obj.text(like_num);
			executing = false;
		});
	});

	document.onreadystatechange = subSomething;//当页面加载状态改变的时候执行这个方法. 
	function subSomething() 
	{ 
		 //当页面加载完成 
		if(document.readyState == "complete"){
			$('#mask').hide();
		}
	} 
</script>
</html>