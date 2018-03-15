$(document).ready(function(){
    $('.btn-toggle').click(function(){
        if($(this).hasClass('on')){
            $(this).removeClass('on');
            $('.slide').removeClass('slide-toggle');
            $('.over').remove();
        } else {
            $(this).addClass('on');
            $('.slide').addClass('slide-toggle');
            $('<div/>').addClass('over').appendTo('#content');
        }
    });
    $('.search-box_button').click(function(){
        if($(this).children().hasClass('fa-search')){
            $(this).children().removeClass('fa-search').addClass('fa-close');
            $('.search-box_input').addClass('search-box_input_show');
        } else {
            $(this).children().removeClass('fa-close').addClass('fa-search');
            $('.search-box_input').removeClass('search-box_input_show');
        }
    });
    $('.icon-user').click(function(){
        $('.slide-collapse').toggle("scale");
    });
});