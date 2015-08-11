(function(){
    document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
    //css3 prefix
    if(navigator.userAgent.indexOf("MSIE")!=-1){window.prefix = '-ms-';}
    if(navigator.userAgent.indexOf("Firefox")!=-1){window.prefix = '-moz-';}
    if(navigator.userAgent.indexOf("Chrome")!=-1||
        navigator.userAgent.indexOf("Safari")!=-1){window.prefix = '-webkit-';}
    if(isOpera=navigator.userAgent.indexOf("Opera")!=-1){
        window.prefix = '-o-';
    }
    //获得模版最佳适配尺寸
    var ratio = 1080/1695;
    function getWH(){
        var win_w = $(window).width();
        var win_h = $(window).height();
        var win_ratio = win_w/win_h;
        var width, height, x, y, scale, fix;
        if(ratio>win_ratio){
            width = win_h*ratio;
            height = win_h;
            x = (win_w-width)/2;
            y = 0;
            scale = win_w/width;
            fix = 'x';
        }else{
            width = win_w;
            height = win_w/ratio;
            x = 0;
            y = (win_h-height)/2;
            scale = win_h/height;
            fix = 'y';
        }

        return {
            win_w:win_w,
            win_h:win_h,
            width: Math.ceil(width),
            height: Math.ceil(height),
            x: Math.ceil(x),
            y: Math.ceil(y),
            scale: scale,
            fix:fix
        };
    }

    function WisStoryPlayer(){
        this.preload = $('#preload');
        this.container = $('#container');
        this.story = null;
        this.animator = new Animator();
        this.hammer = new Hammer(this.container.get(0));
        this.music = document.getElementById('music');
        this.musicControl = $('#musicControl');
    }
    WisStoryPlayer.prototype.load = function(remoteURL,after){
        var me = this;
        var preload = this.preload;
        var sid = location.href.charAt(location.href.length-1);
        var Unix_timestamp = Math.round(new Date().getTime()/1000);
        preload.css({
            width:$(window).width(),
            height:$(window).height()
        });
        $.ajax({
            url:remoteURL,
            type:'POST',
            dataType:'html',
            data:{
                sid: sid,
                expires: Unix_timestamp
            },
            beforeSend:function(request){
                request.setRequestHeader("header", $.md5('sid='+sid+'&expires='+Unix_timestamp));
            },
            success:function(story){
                 me.story = $(story);
                 me.render(after);
            },
            error:function(err){
                console.debug(err);
            }
        });
    };
    WisStoryPlayer.prototype.render = function(after){
        var con = this.container;
        var story = this.story;
        var animator = this.animator;
        var hammer = this.hammer;
        var preference = story.attr('preference');
        var music = this.music;
        var musicControl = this.musicControl;
        var music_flag = false;
        var stages = this.stages = story.find('.stage');
        var demension = getWH();

        function iniStory(){
            con.css({
                width:$(window).width(),
                height:$(window).height()
            });
            stages.css({
                width:demension.win_w,
                height:demension.win_h
            });
            stages.find('.stageBg').css({
                width:demension.width,
                height:demension.height,
                left:demension.x,
                top:demension.y
            });
            if(demension.fix == 'x'){
                stages.find('.stageBg').css(prefix+'transform','scaleX('+demension.scale+')');
            }else if(demension.fix == 'y'){
                stages.find('.stageBg').css(prefix+'transform','scaleY('+demension.scale+')');
            }
            stages.find('.stageContainer').css({
                width:demension.width,
                height:demension.height,
                left:demension.x,
                top:demension.y
            });
            stages.find('.stageContainer').css(prefix+'transform','scale('+demension.scale+','+demension.scale+')');
        }
        function iniPreference(){
            if(preference == 'swipe-up-down'){
                var current = 0,next,top;
                stages.eq(0).css('z-index',3);
                hammer.get('swipe').set({
                    threshold:5,
                    velocity:0.3,
                    direction:24
                });
                hammer.on('swipeup swipedown',function(event){
                    if(event.type == 'swipeup'){
                        if(current+1<stages.size()){
                            next = current + 1;
                            top = '-100%';
                            change();
                        }
                    }else if(event.type == 'swipedown'){
                        if(current-1>-1){
                            next = current - 1;
                            top = '100%';
                            change();
                        }
                    }
                    function change(){
                        var stageA = stages.eq(current),
                            stageB = stages.eq(next);
                        stageB.css('z-index',2);
                        animator.stop(stageA);
                        animator.play(stageB);
                        stageA.animate({
                            marginTop:top
                        },500,function(){
                            stageA.css('z-index',1);
                            stageB.css('z-index',3);
                            stageA.css('margin-top','0');
                            current = next;
                        });
                    }
                });
            }else if(preference == 'swipe-left-right'){
                var current = 0,next,left;
                stages.eq(0).css('z-index',3);
                hammer.get('swipe').set({
                    threshold:5,
                    velocity:0.3,
                    direction:6
                });
                hammer.on('swipeleft swiperight',function(event){
                    if(event.type == 'swipeleft'){
                        if(current+1<stages.size()){
                            next = current + 1;
                            left = '-100%';
                            change();
                        }
                    }else if(event.type == 'swiperight'){
                        if(current-1>-1){
                            next = current - 1;
                            left = '100%';
                            change();
                        }
                    }
                    function change(){
                        var stageA = stages.eq(current),
                            stageB = stages.eq(next);
                        stageB.css('z-index',2);
                        animator.stop(stageA);
                        animator.play(stageB);
                        stageA.animate({
                            marginLeft:left
                        },500,function(){
                            stageA.css('z-index',1);
                            stageB.css('z-index',3);
                            stageA.css('margin-left','0');
                            current = next;
                        });
                    }
                });
            }
        }
        function iniMusic(){
            music.src = story.attr('music-src');
            music.load();
            document.addEventListener('touchstart',function(){
                if(!music_flag){
                    music.play();
                    music_flag = true;
                }
            });
            musicControl.click(function(){
                if(music.paused){
                    music.play();
                }else{
                    music.pause();
                }
            });
        }
        iniStory();
        iniPreference();
        iniMusic();

        con.html(story);
        con.imagesLoaded(function(){
            after.call();
        });
    };

    window.WisStoryPlayer = WisStoryPlayer.prototype.constructor;
})();