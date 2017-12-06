$(document).ready(function(){
    $(".project").hide();
    $('#project_action').mousemove(function(){
        $(".project").show();
        $(".instance_span span").show();
    });
    $('.project').mousemove(function(){
        $(".project").show();
        $(".instance_span span").show();
    });
    $('#project_action').mouseout(function(){
        $(".project").hide();
        $(".instance_span span").hide();
    });
    $('.project').mouseout(function(){
        $(".project").hide();
        $(".instance_span span").hide();
    });

    // $('.left_arrow').css('backgound','_IMAGE_');
    
    var image_count = image_array.length;

    var image_height = '500px';
    for( var i = 0; i < image_count + 1; i++){
        $('.cycle ul').append('<li></li>');
    }
    for(var i = 0 ;i < image_count;i++){
        if(i == 0){
            $('.cycle ol').append('<li class="current_point"></li>');    
        }else
        $('.cycle ol').append('<li></li>');
    }
    // $('.cycle ol li').eq(0).addClass('current_point');
    // $('.cycle ol').css('width','20px');
    // $()
    // $('.cycle ol').css('height','20px');

   let window_width = $(window).width();
   
    $('.cycle ul').css('width',100 * (image_count + 1) + '%');
    $('.cycle ul').css('height',image_height);
    $('.cycle ul li').css('width',100 / (image_count+1)+'%');
    $('.cycle ul li').css('height',image_height);
    $('.cycle ul li').css('background-image','url('+image_array[0]+')');
    $.each(image_array,function(key,value){

        $('.cycle ul li').eq(key).css('background-image','url('+value+')');

    });
    $(window).resize(function(){
        window_width = $(window).width();
        $('.cycle ul li').css('width',window_width + 'px');
    });
    var page = 0 ;
    var timer = null;
    timer = setInterval(nextStep,2000);
    function preStep(){
        page --;
        if(page >=0){
            $('.cycle ul').stop().animate({left:-page * window_width + 'px'},500);
            //  css('left',-page * window_width + 'px');
         }else{
            page = image_count - 1; 
            $('.cycle ul').css('left',-(image_count) * window_width + 'px').stop().animate({left:-page * window_width + 'px'},500);
        }
        $('.cycle ol li').eq(page%image_count).addClass('current_point').siblings().removeClass('current_point');
    }
    function nextStep(){
        page ++;
        if(page <= image_count){
            $('.cycle ul').stop().animate({left:-page * window_width + 'px'},500);
        }else{
            page = 1;
            $('.cycle ul').css('left',0 + 'px').stop().animate({left:-page * window_width + 'px'},500);
        }
        $('.cycle ol li').eq(page%image_count).addClass('current_point').siblings().removeClass('current_point');
    }
    $('.cycle').mouseenter(function(){
        clearInterval(timer);
        $('.left_arrow').fadeIn('fast');
        $('.right_arrow').fadeIn('fast');
    });
    $('.cycle').mouseleave(function(){
        timer = setInterval(nextStep,2000);
        $('.left_arrow').fadeOut('fast');
        $('.right_arrow').fadeOut('fast');
    });
    $('.left_arrow').click(function(){
        preStep();
    });
    $('.right_arrow').click(function(){
        nextStep();
    });
    $('.cycle ol li').click(function(){
        var index = $(this).index();
        page = index;
        $('.cycle ul').css('left',-index * window_width + 'px');
        $(this).addClass('current_point').siblings().removeClass('current_point');
    });
    $('.cycle ul li').click(function(){
        var index = $(this).index();
        if(index < href_array.length)
        window.open(href_array[index],'__blank');
    });

});