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
<script type="text/javascript">
function changePage(flag){
	//开始按键,初始化
	preChange(	);
	
    var imgs = $(".m-img").length;

	//判断是否开始或者在移动中获取值
	if(start||startM){
		startM = true;
		mousedown&&(moveP = flag?firstP+150:firstP-150);
		page_n == 1 ? indexP = false : indexP = true ;	//true 为不是第一页 false为第一页
	}
	
	//设置一个页面开始移动
	if(moveP&&startM&&imgs>1){
		
		//判断方向并让一个页面出现开始移动
		if(!p_b){
			p_b = true;
			position = moveP - initP > 0 ? true : false;	//true 为向下滑动 false 为向上滑动
			if(position){
			//向下移动
				if(indexP){								
					newM = page_n - 1 ;
					$(".m-page").eq(newM-1).addClass("active").css("top",-v_h);
					move = true ;
				}else{
					if(canmove){
						move = true;
						newM = Msize;
						$(".m-page").eq(newM-1).addClass("active").css("top",-v_h);
					}
					else move = false;
				}
						
			}else{
			//向上移动
				if(page_n != Msize){
					if(!indexP) $('.audio_txt').addClass('close');
					newM = page_n + 1 ;
				}else{
					if(!gd){move = false; return};
					newM = 1 ;
				}
				$(".m-page").eq(newM-1).addClass("active").css("top",v_h);
				move = true ;
			} 
		}
		
		//根据移动设置页面的值
		if(!DNmove){
			//滑动带动页面滑动
			if(move){	
				
			
				//移动中设置页面的值（top）
				start = false;
				var topV = parseInt($(".m-page").eq(newM-1).css("top"));
				$(".m-page").eq(newM-1).css({'top':topV+moveP-initP});	
				
			    if(topV+moveP-initP>0){//向上
				   var bn1 = winHeight-(topV+moveP-initP);
				   var bn2 = ((winHeight-bn1/4)/winHeight);
                   $(".m-page").eq(newM-2).attr("style","-webkit-transform:translate(0px,-"+bn1/4+"px) scale("+bn2+")");
			    }else{//向下
				   var bn3 = winHeight+(topV+moveP-initP);
				   var bn4 = ((winHeight-bn3/4)/winHeight);
				   if(Msize!=newM){
                     $(".m-page").eq(newM).attr("style","-webkit-transform:translate(0px,"+bn3/4+"px) scale("+bn4+")");
				   }else{
					 $(".m-page").eq(0).attr("style","-webkit-transform:translate(0px,"+bn3/4+"px) scale("+bn4+")");  	
				   }  
			    }
				initP = moveP;
			}else{
				moveP = null;	
			}
		}else{
			console.log('2')
			moveP = null;	
		}
	}
//结束按键,还原
	afterChange();
}

function preChange(){
		initP = $(".m-page").eq(page_n-1).position().top;
		mousedown = true;
		firstP = initP;	
}

function afterChange(){
		
	//结束控制页面
	startM =null;
	p_b = false;
	
	
	//判断移动的方向
	var move_p;	
	position ? move_p = moveP - firstP > 100 : move_p = firstP - moveP > 100 ;
	if(move){
		//切画页面(移动成功)
		if( move_p && Math.abs(moveP) >5 ){	
			$(".m-page").eq(newM-1).animate({'top':0},300,"easeOutSine",function(){
				/*
				** 切换成功回调的函数
				*/
				success();
				$(".m-page").attr("style","");
			})
		//返回页面(移动失败)
		}else if (Math.abs(moveP) >=5){	//页面退回去
			position ? $(".m-page").eq(newM-1).animate({'top':-v_h},100,"easeOutSine") : $(".m-page").eq(newM-1).animate({'top':v_h},100,"easeOutSine");
			$(".m-page").attr("style","");
			$(".m-page").eq(newM-1).removeClass("active");
			start = true;
			$(".m-page").attr("style","");
		}
	}
	/* 初始化值 */
	initP		= null,			//初值控制值
	moveP		= null,			//每次获取到的值
	firstP		= null,			//第一次获取的值
	mousedown	= null;			//取消鼠标按下的控制值
}
</script>
</body>
</html>