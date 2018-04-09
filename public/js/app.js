﻿var homeUrl = $('base').attr('href');
var error = $('<div/>').addClass('alert alert-danger');
var success = $('<div/>').addClass('alert alert-success');
var csrfToken = $('meta[name="csrf-token"]').attr('content');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': csrfToken
    }
});
$(document).ready(function() {
    $('.film-name').tooltip();
    $('.btn-toggle').click(function() {
        if ($(this).hasClass('on')) {
            $(this).removeClass('on');
            $('.slide').removeClass('slide-toggle');
            $('.over').remove();
        } else {
            $(this).addClass('on');
            $('.slide').addClass('slide-toggle');
            $('<div/>').addClass('over').appendTo('#content');
        }
    });
    $('.search-box_button').click(function() {
        if ($(this).children().hasClass('fa-search')) {
            $(this).children().removeClass('fa-search').addClass('fa-close');
            $('.search-box_input').addClass('search-box_input_show');
            $('.search-box_button_open').toggle('slide');
        } else {
            $(this).children().removeClass('fa-close').addClass('fa-search');
            $('.search-box_input').removeClass('search-box_input_show');
            $('.search-box_button_open').toggle('slide');
        }
    });
    $('.icon-user').click(function() {
        $('.slide-collapse').toggle("scale");
    });
});
$(document).on('submit', '#login-form', function(event) {
    event.preventDefault();
    error.remove();
    var email = $('input[name=email]');
    var password = $('input[name=password]');
    var btn = $(this).children('.button');
    var data = new FormData(this);
    btn.attr('class', 'btn-loading');
    $.ajax({
        url: homeUrl + '/login',
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        type: 'POST',
        success: function(res) {
            btn.attr('class', 'button');
            $("#login-form").remove();
            success.text(res.message).appendTo('#result');
            setTimeout(function() {
                location.href = res.redirectUrl;
            }, 2000);
        },
        error: function(err) {
            btn.attr('class', 'button');
            error.text(err.responseJSON.message).appendTo('#result');
        }
    });
});
$(document).on('submit', '#register-form', function(event) {
    event.preventDefault();
    error.remove();
    var email = $('input[name=email]');
    var password = $('input[name=password]');
    var confirmPassword = $('input[name=confirm_password]');
    var btn = $(this).children('.button');
    var data = new FormData(this);
    btn.attr('class', 'btn-loading');
    if (email.val() === "") {
        btn.attr('class', 'button');
        inputFailed.appendTo(email.parent());
        error.text("Vui lòng nhập email!").appendTo('#result');
        return false;
    } else if (password.val() === "") {
        btn.attr('class', 'button');
        error.text("Vui lòng nhập mật khẩu!").appendTo('#result');
        return false;
    }
    $.ajax({
        url: homeUrl + '/register',
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        type: 'POST',
        success: function(res) {
            btn.attr('class', 'btn');
            $("#register-form").remove();
            success.text(res.message).appendTo('#result');
            setTimeout(function() {
                location.href = res.redirectUrl;
            }, 2000);
        },
        error: function(err) {
            btn.attr('class', 'btn');
            error.text(err.responseJSON.message).appendTo('#result');
        }
    });
});
$(document).on('click', '.film-eposide span', function() {
    var id = $(this).data('eposide');
    var active = $('.film-eposide span.active');
    if ($(this).hasClass('active')) {
        return false;
    }
    active.removeClass('active');
    $(this).addClass('active');
    $.ajax({
        url: homeUrl + '/ajax/source/' + id,
        processData: false,
        success: function(res) {
            play(res.source, res.poster, res.name);
        }
    });
});
$(document).on('click', '.over, .closex', function() {
    $('.login-dialog').remove();
    $('.over').remove();
});
$(document).on('click', '.report', function() {
    var id = $(this).data('film');
    $.ajax({
        url: homeUrl + '/ajax/report/' + id,
        processData: false,
        success: function(res) {
            $('<div/>').addClass('over').appendTo('body');
            $('body').append(res);
        }
    });
});
$(document).on('submit', '#report-form', function(event) {
    event.preventDefault();
    error.remove();
    var email = $('input[name=email]');
    var message = $('input[name=message]');
    var id = $('input[name=film]');
    var btn = $(this).children('.button');
    var data = new FormData(this);
    btn.attr('class', 'btn-loading');
    $.ajax({
        url: homeUrl + '/ajax/report/' + id,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        type: 'POST',
        success: function(res) {
            btn.attr('class', 'button');
            $("#report-form").remove();
            success.text(res.message).appendTo('#result');
        },
        error: function(err) {
            btn.attr('class', 'button');
            error.text(err.responseJSON.message).appendTo('#result');
        }
    });
});
$(document).on('click', '#like-button', function(event) {
    var id = $(this).data('id');
    var _this = this;
    $.ajax({
        url: homeUrl + '/ajax/like/' + id,
        processData: false,
        success: function(res) {
            if (res.code) {
                $(_this).css({
                    color: '#f00'
                });
                $(_this).children('span').text('Đã thích');
            } else {
                $(_this).css('color', '');
                $(_this).children('span').text('Yêu thích');
            }
        }
    });
});
var selected = false;
$(document).on('click', '.star-white', function(e) {
    if (selected) {
        return false;
    }
    var index = $(this).index();
    var id = $(this).parent().data('id');
    $('.list-star').children().removeClass('star');
    for (var i = 0; i <= index; i++) {
        $('.list-star .star-white:eq(' + i + ')').addClass('star');
    }
    $.ajax({
        url: homeUrl + '/ajax/vote/' + id,
        type: "POST",
        data: { 'point': ++index },
        async: false,
        success: function(res) {
            if (res.code) {
                selected = true;
            }
        }
    });
});
$(document).on('mouseover', '.star-white', function(e) {
    if (selected) {
        return false;
    }
    var index = $(this).index();
    for (var i = 0; i <= index; i++) {
        $('.list-star .star-white:eq(' + i + ')').addClass('star');
    }
});
$(document).on('mouseleave', '.star-white', function(e) {
    if (selected) {
        return false;
    }
    $('.list-star').children().removeClass('star');
});
$(document).on('change', 'input[name=category_parent]', function(e) {
    var id = this.value;
    $.ajax({
        url: homeUrl + '/admin/film/category',
        data: { 'id': id },
        success: function(res) {
            var html = '';
            $.each(res, function(key, val) {
                html += '<li><input type="checkbox" name="category[]" value="' + val.id + '">' + val.name + '</li>';
            });
            $('#dropSelect').html(html);
        }
    });
});
$(document).on('click', '#category_parent li', function(e) {
    var id = $(this).children('input')[0].value;
    $.ajax({
        url: homeUrl + '/admin/film/category',
        data: { 'id': id },
        success: function(res) {
            var html = '';
            $.each(res, function(key, val) {
                html += '<li><input type="checkbox" name="category[]" value="' + val.id + '">' + val.name + '</li>';
            });
            $('#dropSelect').html(html);
        }
    });
});
$(document).on('click', '.dropSelect li', function(e) {
    $(this).children('input')[0].checked = true;
});

$(document).on('submit', '#add-film-form', function(event) {
    event.preventDefault();
    error.remove();
    var btn = $(this).children().find('.button');
    var data = new FormData(this);
    btn.attr('class', 'btn-loading');
    $.ajax({
        url: homeUrl + '/admin/film/add',
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        type: 'POST',
        success: function(res) {
            btn.attr('class', 'button');
            success.text(res.message).appendTo('#result');
            $('#add-film-form')[0].reset();
        },
        error: function(err) {
            btn.attr('class', 'button');
            error.text(err.responseJSON.message).appendTo('#result');
        }
    });
});
$(document).on('submit', '#edit-film-form', function(event) {
    event.preventDefault();
    error.remove();
    var btn = $(this).children().find('.button');
    var data = new FormData(this);
    btn.attr('class', 'btn-loading');
    $.ajax({
        url: homeUrl + '/admin/film/edit',
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        type: 'POST',
        success: function(res) {
            btn.attr('class', 'button');
            success.text(res.message).appendTo('#result');
            $('#add-film-form')[0].reset();
        },
        error: function(err) {
            btn.attr('class', 'button');
            error.text(err.responseJSON.message).appendTo('#result');
        }
    });
});
$(document).on('click', '#delete-film', function(e) {
    var id = $(this).data('id');
    $.ajax({
        url: homeUrl + '/admin/film/delete',
        data: { 'id': id },
        success: function(res) {
            $('<div/>').addClass('over').appendTo('body');
            $('body').append(res);
        }
    });
});
$(document).on('click', '#confirm-delete', function(e) {
    var id = $(this).data('id');
    $.ajax({
        url: homeUrl + '/admin/film/delete',
        type: "POST",
        data: { 'id': id },
        success: function(res) {
            $('.login-dialog').remove();
            $('.over').remove();
            $('<div/>').addClass('over').appendTo('body');
            $('body').append(res);
        }
    });
});
submitSourceForm('#add-source-form', 'add');
submitSourceForm('#edit-source-form', 'edit');

function submitSourceForm(element, action) {
    $(document).on('submit', element, function(event) {
        var id = $(this).data('id');
        event.preventDefault();
        error.remove();
        var btn = $(this).children().find('.button');
        var data = new FormData(this);
        btn.attr('class', 'btn-loading');
        $.ajax({
            url: homeUrl + '/admin/film/source/' + id + '/' + action,
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            type: 'POST',
            success: function(res) {
                btn.attr('class', 'button');
                success.text(res.message).appendTo('#result');
                $(element)[0].reset();
            },
            error: function(err) {
                btn.attr('class', 'button');
                error.text(err.responseJSON.message).appendTo('#result');
            }
        });
    });
}
//play function
function play(source, poster, title) {
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