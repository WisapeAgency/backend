$(function(){
	window.onload = function()
	{
		var $li = $('#tab li');
		var $ul = $('#content div');
						
		$li.click(function(){
			var $this = $(this);
			var $t = $this.index();
			$li.removeClass();
			$this.addClass('current');
			$ul.css('display','none');
			$ul.eq($t).css('display','block');
		})
	}
});





$(document).ready(function(){
	$(".content_form_input").each(function(){
		var thisVal=$(this).val();
    	 //判断文本框的值是否为空，有值的情况就隐藏提示语，没有值就显示
     	if(thisVal!=""){
       		$(this).siblings("span").hide();
     	 }else{
       		$(this).siblings("span").show();
      	}
			//输入框焦点验证 
		$(this).focus(function(){
			$(this).siblings("span").hide();
			}).blur(function(){
        			var val=$(this).val();
        			if(val!=""){
					$(this).siblings("span").hide();
        		}else{
					$(this).siblings("span").show();
        		} 
			});
    });
});