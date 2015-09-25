

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