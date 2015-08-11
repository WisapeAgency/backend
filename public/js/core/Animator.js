(function(){
    function Animator(){
        this.timerGroup = new Array();
    }
    Animator.prototype.play = function(stage){
        var aniSymbols = stage.find('[animation]');
        var timerGroup = this.timerGroup;
        aniSymbols.each(function(){
            var This = $(this);
            var style = This.attr('style') || '';
            var aniObj,aniCss;

            if(This.get(0).aniObj){
                aniObj = This.get(0).aniObj;
            }else{
                var aniData = This.attr('animation').split('|');
                aniObj = new Object();
                for(var i in aniData){
                    var s = aniData[i].split(':');
                    aniObj[s[0]]=s[1];
                }
                This.get(0).aniObj = aniObj;
            }

            This.attr('animation','ready');
            aniCss = '';
            aniCss += prefix + 'animation-name:' + aniObj.name + ';';
            aniCss += prefix + 'animation-duration:' + aniObj.dura + ';';
            aniCss += prefix + 'animation-timing-function:' + aniObj.func + ';';
            aniCss += prefix + 'animation-delay:' + aniObj.delay + ';';
            aniCss += prefix + 'animation-iteration-count:' + aniObj.count;

            This.css('opacity',0);
            This.attr('style',style+aniCss);
            This.on('animationend',function(){
                This.attr('style',style);
            });
        });
    };
    Animator.prototype.stop = function(stage){
        var aniSymbols = stage.find('[animation]');
        var timerGroup = this.timerGroup;
        for(var i in timerGroup){
            window.clearTimeout(timerGroup[i]);
        }
        timerGroup = new Array();
        aniSymbols.trigger('animationend');
    };
    window.Animator = Animator.prototype.constructor;
})();