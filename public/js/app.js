﻿var homeUrl = $('base').attr('href');
var error = $('<div/>').addClass('alert alert-danger');
var success = $('<div/>').addClass('alert alert-success');
var csrfToken = $('meta[name="csrf-token"]').attr('content');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': csrfToken
    }
});
$(document).ready(function(){
    $('.film-name').tooltip();
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
    error.remove();
    var email = $('input[name=email]');
    var password = $('input[name=password]');
    var btn = $(this).children('.button');
    var data = new FormData(this);
    btn.attr('class', 'btn-loading');
    $.ajax({
        url: homeUrl + '/login',
        data: $(this).serialize(),
        processData: false,
        type: 'POST',
        success: function(res){
            btn.attr('class', 'button');
            $("#login-form").remove();
            success.text(res.message).appendTo('#result');
            setTimeout(function(){
                location.href = res.redirectUrl;
            }, 2000);
        },
        error: function(err){
            btn.attr('class', 'button');
            error.text(err.responseJSON.message).appendTo('#result');
        }
    });
});
$(document).on('submit', '#register-form', function(event){
    event.preventDefault();
    error.remove();
    var email = $('input[name=email]');
    var password = $('input[name=password]');
    var confirmPassword = $('input[name=confirm_password]');
    var btn = $(this).children('.button');
    var data = new FormData(this);
    btn.attr('class', 'btn-loading');
    if(email.val() === ""){
        btn.attr('class', 'button');
        inputFailed.appendTo(email.parent());
        error.text("Vui lòng nhập email!").appendTo('#result');
        return false;
    } else if(password.val() === ""){
        btn.attr('class', 'button');
        error.text("Vui lòng nhập mật khẩu!").appendTo('#result');
        return false;
    }
    $.ajax({
        url: homeUrl + '/register',
        data: $(this).serialize(),
        processData: false,
        type: 'POST',
        success: function(res){
            btn.attr('class', 'btn');
            $("#register-form").remove();
            success.text(res.message).appendTo('#result');
            setTimeout(function(){
                location.href = res.redirectUrl;
            }, 2000);
        },
        error: function(err){
            btn.attr('class', 'btn');
            error.text(err.responseJSON.message).appendTo('#result');
        }
    });
});
$(document).on('click', '.film-eposide span', function(){
    var id = $(this).data('eposide');
    var active = $('.film-eposide span.active');
    if($(this).hasClass('active')){
        return false;
    }
    active.removeClass('active');
    $(this).addClass('active');
    $.ajax({
        url: homeUrl + '/ajax/source/'+id,
        processData: false,
        success: function(res){
            play(res.source, res.poster, res.name);
        }
    });
});
function play(source, poster, title){
    $('#player').children().remove();
    jwplayer('player').setup({
        sources: [{
                file: source.m18,
                type: 'video/mp4',
                label: "480p"
            },
            {
                file: source.m22,
                type: 'video/mp4',
                label: "720p"
            },
            {
                file: source.m36,
                type: 'video/mp4',
                label: "1080p"
            }
        ],
        image: poster,
        title: title
    });
}