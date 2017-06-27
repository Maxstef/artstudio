$('document').ready(function () {
    var wrapW = $("#more-news-widget").width();
    var innW = $("#more-news-widget").find(".more-news-text h6").width();
    $("#more-news-widget").find(".more-news-text h6").css({ 'left': (wrapW - innW) / 2 + 'px' });
    $(".main-page-item").hover(function () {
        var width = $(this).find('.main-page-img').width();
        var height = $(this).find('.main-page-img').height();
        $(this).find('.painted-black').css({ 'width': width + 'px', 'height': height + 'px', 'opacity': '0.4' });
    }, function () {
        $(this).find('.painted-black').css({ 'opacity': '0' });
    });

    $(".footer-to-top").on('click', function () {
        var duration = 100;
        var y = pageYOffset,
            step = (pageYOffset * 10) / duration,
            timer;
        timer = setInterval(function () {
            scrollTo(0, pageYOffset - step);
            if (pageYOffset <= step) {
                scrollTo(0, 0);
                clearInterval(timer);
            }
        }, 10);
    });
    $("#upload-btn").on("click", function () {
        var file = document.getElementById('upload-image').files[0];
        var data = new FormData();
        data.append('file', file);
        if (typeof file == "undefined") {
            $("#no-file").fadeIn(300);
            return;
        } else {
            $("#no-file").fadeOut(300);
        }

        $.ajax({
            type: "POST",
            url: "../../actions/upload.php",
            processData: false,
            contentType: false,
            data: data,
            success: function (res) {
                $("#uploaded-img").attr("src", "../../uploaded/" + res);
                $("#success-upload").fadeIn(300);
                $("#uploaded-image").remove();
                if ($(".new-post-form").length) {
                    $(".new-post-form").append("<input id='uploaded-image' style='display: none' name='photo' value='" + res + "'>");
                } else if ($(".edit-post-form").length) {
                    $(".edit-post-form").append("<input id='uploaded-image' style='display: none' name='photo' value='" + res + "'>");
                }
            }
        });
    });
    $(".new-post-form").on('submit', function (e) {
        if ($("#uploaded-image").length > 0) {
            return;
        } else {
            e.preventDefault();
            $("#no-file").fadeIn(300);
        }
    });
});

$(window).resize(function(){
    var wrapW = $("#more-news-widget").width();
    var innW = $("#more-news-widget").find(".more-news-text h6").width();
    $("#more-news-widget").find(".more-news-text h6").css({ 'left': (wrapW - innW) / 2 + 'px' });
});

function publish(id){
    var io = $("#news-" + id).find(".checkbox");
    if(io.attr('checked') == 'checked'){
        $.ajax({
            type: "POST",
            url: "../../actions/publish.php",
            data: {
                published: 0,
                id: id
            },
            success: function (res) {
                io.removeAttr('checked');
            }
        });  
    } else {
        $.ajax({
            type: "POST",
            url: "../../actions/publish.php",
            data: {
                published: 1,
                id: id
            },
            success: function (res) {
                io.attr('checked', 'checked');
            }
        });
    }
}

function onMain(id){
    var io = $("#on-main-" + id);
    if(io.attr('checked') == 'checked'){
        $.ajax({
            type: "POST",
            url: "../../actions/publish.php",
            data: {
                onmain: 0,
                id: id
            },
            success: function (res) {
                io.removeAttr('checked');
            }
        });
    } else {
        $.ajax({
            type: "POST",
            url: "../../actions/publish.php",
            data: {
                onmain: 1,
                id: id
            },
            success: function (res) {
                io.attr('checked', 'checked');
            }
        });
    }
}

function confirmDeletePost(e, title){
    if(!confirm('Ви впевнeні що хочете видалити новину ' + title)){
        e.preventDefault();
    }
}

function onSubscribe(e){
    console.log('here');
    e.preventDefault();
    var email = $("#subs-email").val();
    $.ajax({
        type: "POST",
        url: "../../actions/subscribe.php",
        data: {
            email: email
        },
        success: function (res) {
            $("#suscribe-feedback").text(res);
            $("#suscribe-feedback").fadeIn(300);
        }
    });
}