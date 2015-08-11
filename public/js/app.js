(function(){
    var player = new WisStoryPlayer();
    Pace.on('start',function(){
        player.load(LOADSTORYURL,function(){
            Pace.stop();
            player.preload.hide();
            player.animator.play(player.stages.eq(0));
        });
    });
    Pace.start({
        ajax: false,
        document: true,
        eventLag: true,
        elements: {
            selectors: ['body']
        }
    });
})();