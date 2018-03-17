var homeUrl = $('base').attr('href');
var errorAlert = $('<div/>').addClass('alert alert-danger');
var csrfToken = $('meta[name="csrf-token"]').attr('content');
var inputFailed = $('<span/>').addClass('input-failed').tooltip();
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': csrfToken
    }
});
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
$(document).on('submit', '#login-form', function(event){
    event.preventDefault();
    var email = $('input[name=email]');
    var password = $('input[name=password]');
    var btn = $(this).children('.btn');
    var data = new FormData(this);
    btn.attr('class', 'btn-loading');
    $.ajax({
        url: homeUrl + '/login',
        data: $(this).serialize(),
        processData: false,
        type: 'POST',
        success: function(res){
            btn.attr('class', 'btn');
        },
        error: function(err){
            btn.attr('class', 'btn');
            errorAlert.text(err.responseJSON.message).appendTo('#result');
        }
    });
});
$(document).on('submit', '#register-form', function(event){
    event.preventDefault();
    var email = $('input[name=email]');
    var password = $('input[name=password]');
    var confirmPassword = $('input[name=confirm_password]');
});