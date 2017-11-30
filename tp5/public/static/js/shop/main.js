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

});