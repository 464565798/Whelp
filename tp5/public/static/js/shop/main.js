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
        $('.cycle ul').append('<li><img></img></li>');
    }
    for(var i = 0 ;i < image_count;i++){
        if(i == 0){
            $('.cycle ol').append('<li class="current_point"></li>');    
        }else
        $('.cycle ol').append('<li></li>');
    }


   let window_width = $(window).width() > 1250 ? $(window).width() : 1250;
   
    $('.cycle ul').css('width',window_width * (image_count + 1) + 'px');
    $('.cycle ul').css('height',image_height);
    $('.cycle ul li').css('width',window_width + 'px');
    $('.cycle ul li').css('height',image_height);
    // $('.cycle ul li img').css('src','url('+image_array[0]+')');
    // $('.cycle ul img').attr("src", image_array[0]);
    $.each(image_array,function(key,value){

        // $('.cycle ul li img').eq(key).css('src','url('+value+')');
        $('.cycle ul img').eq(key).attr("src", value);

    });
    $('.cycle ul img').eq(image_count).attr("src", image_array[0]);
    $(window).resize(function(){
        window_width = $(window).width() > 1250 ? $(window).width() : 1250;
        $('.cycle ul li').css('width',window_width + 'px');
        $('.cycle ul').stop().css('left',- page * window_width + 'px');
        $('.cycle ul').css('width',(image_count + 1) * window_width + 'px');
    });
    var page = 0 ;
    var timer = null;
    timer = setInterval(nextStep,2000);
    function preStep(){
        page --;
        if(page >=0){
            $('.cycle ul').stop().animate({left:-page * window_width + 'px'},500);
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
//宣传区

    let divArray = $('#specialWork button');
    
    $.each(divArray,function(key,value){
        let index = $(this).index();
        $(this).mousedown(function(){
            window.open(publishButtonAction[index],'__blank');
        });
        $(this).mouseenter(function(){
            $(this).css('background','rgb(58,184,136)');
        });
        $(this).mouseleave(function(){
            $(this).css('background','transparent');
        });

    });
    $(window).scroll(function(){
        let scrollerToTop = $(window).scrollTop();
        if(scrollerToTop > 300){
            $('.top_parent_div').removeClass('top_parent_div').addClass('top_parent_float_div');
        }else{
            $('.top_parent_float_div').removeClass('top_parent_float_div').addClass('top_parent_div');
        }
    });

    let showP = $('.download p');
    let showImage = $('.download div').children('img');

    var hadSelectJava = showP.eq(0);
    var hadSelectB2b2c = showP.eq(3);
    hadSelectJava.find('img').attr('src',select_product[0]);
    hadSelectJava.css('background','#1D82C7');
    hadSelectJava.css('color','white');
    hadSelectB2b2c.find('img').attr('src',select_product[0]);
    hadSelectB2b2c.css('background','#1D82C7');
    hadSelectB2b2c.css('color','white');

    $(showP).click(function(){

        $(this).css('background','#1D82C7').siblings().css('background','white');
        
        
        if($(showP).index($(this))< 3){
            hadSelectJava.find('img').attr('src',product[hadSelectJava.index()-1]);
            hadSelectJava.css('color','black');
            hadSelectJava = $(this);
            $(this).find('img').attr('src',select_product[$(this).index()-1]);
            showImage.eq(0).attr('src',javaBar[$(this).index()-1]);
            hadSelectJava.css('color','white');
        }else{
            hadSelectB2b2c.find('img').attr('src',product[hadSelectB2b2c.index()-1]);
            hadSelectB2b2c.css('color','black');
            hadSelectB2b2c = $(this);
            $(this).find('img').attr('src',select_product[$(this).index()-1]);
            showImage.eq(1).attr('src',b2b2cBar[$(this).index()-1]);
            hadSelectB2b2c.css('color','white');
        }

    });
    $('.price-ads table td').mouseenter(function(){
        $(this).css('background','white');
    }).mouseleave(function(){
        $(this).css('background','rgb(250, 250, 250)');
    });

});