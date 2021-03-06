$('document').ready(function () {
    var wrapW = $("#more-news-widget").width();
    var innW = $("#more-news-widget").find(".more-news-text h6").width();
    $("#more-news-widget").find(".more-news-text h6").css({ 'left': (wrapW - innW) / 2 + 'px' });
    $(".main-page-item").hover(function () {
        var width = $(this).find('.main-page-img').width();
        var height = $(this).find('.main-page-img').height();
        var pW = $(this).find('.photo-white').width();
        var pH = $(this).find('.photo-white').height();
        $(this).find('.painted-black').css({ 'width': width + 'px', 'height': height + 'px', 'opacity': '0.4' });
        $(this).find('.photo-white').css({ 'left': (width - pW)/2 + 'px', 'top': (height - pW)/2 + 'px', 'opacity': '1' });
    }, function () {
        $(this).find('.painted-black').css({ 'opacity': '0' });
        $(this).find('.photo-white').css({ 'opacity': '0' });
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

function upload(destination, galleryId){
    var file = document.getElementById('upload-image').files[0];
    var data = new FormData();
    data.append('file', file);
    data.append('destination', destination);
    if(typeof galleryId !== 'undefined'){
        data.append('gallery', galleryId);
    }
    if (typeof file == "undefined") {
        $("#no-file").fadeIn(300);
        return;
    } else {
        $("#no-file").fadeOut(300);
    }
    $("#upload-loading").show();
    $.ajax({
        type: "POST",
        url: "../../actions/upload.php",
        processData: false,
        contentType: false,
        data: data,
        success: function (res) {
            $("#upload-loading").hide();
            if(destination === 'post'){
                $("#uploaded-img").attr("src", "../../uploaded/" + destination + "/" + res);
                $("#success-upload").fadeIn(300);
                $("#uploaded-image").remove();
                if ($(".new-post-form").length) {
                    $(".new-post-form").append("<input id='uploaded-image' style='display: none' name='photo' value='" + res + "'>");
                } else if ($(".edit-post-form").length) {
                    $(".edit-post-form").append("<input id='uploaded-image' style='display: none' name='photo' value='" + res + "'>");
                }
            }
            if(destination === 'gallery'){
                $("#images-container").append("<div class='col-12 col-md-6 col-lg-4 image-gallery-wrapper'><img src='../../uploaded/" + destination + "/" + res + "' alt='gallery-image' style='width: 100%'></div>")
            }
        }
    });
}

function publish_post(id){
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

function publish_gallery(id){
    var io = $("#gallery-" + id).find(".checkbox");
    if(io.attr('checked') == 'checked'){
        $.ajax({
            type: "POST",
            url: "../../actions/publish_gallery.php",
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
            url: "../../actions/publish_gallery.php",
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

function publish_question(id){
    var io = $("#question-" + id).find(".checkbox");
    if(io.attr('checked') == 'checked'){
        $.ajax({
            type: "POST",
            url: "../../actions/publish_question.php",
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
            url: "../../actions/publish_question.php",
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

function confirmDeletePost(e){
    if(!confirm('Ви впевнeні що хочете видалити новину?')){
        e.preventDefault();
    }
}

function confirmDeleteQuestion(e){
    if(!confirm('Ви впевнeні що хочете видалити питання?')){
        e.preventDefault();
    }
}

function confirmDeleteGallery(e){
    if(!confirm('Ви впевнeні що хочете видалити галерею?')){
        e.preventDefault();
    }
}

function onSubscribe(e){
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

function sendMessage(e){
    e.preventDefault();
    var name = $("#feedback-form-name").val();
    var contacts = $("#feedback-form-contacts").val();
    var message = $("#feedback-form-message").val();
    $.ajax({
        type: "POST",
        url: "../../actions/new_question.php",
        data: {
            name: name,
            contacts: contacts,
            message: message
        },
        success: function (res) {
            $("#feedback-form-feedback").text(res);
            $("#feedback-form-feedback").fadeIn(300);
            $("#feedback-form-submit-btn").attr('disabled', 'disabled');
        }
    });
}

function sendMail(e){
    e.preventDefault();
    $("#mail-loader").fadeIn(300);
    $("#mail-form-submit-btn").attr('disabled', 'disabled');
    $("#mail-form-feedback").text('Виконується розсилка');
    $("#mail-form-feedback").fadeIn(300);
    var theme = $("#mail-form-contacts").val();
    var message = $("#mail-form-message").val();
    $.ajax({
        type: "POST",
        url: "../../actions/mail.php",
        data: {
            theme: name,
            message: message
        },
        success: function (res) {
            $("#mail-form-feedback").text(res);
            $("#mail-form-feedback").fadeIn(300);
            $("#mail-loader").fadeOut(300);
        }
    });
}

function deleteImg(id){
    $("#image-" + id).append("<p class='loader' style='position: absolute; left: 45%; top: 45%;'></p>")
    $.ajax({
        type: "POST",
        url: "../../actions/delete_photo.php",
        data: {
            id: id
        },
        success: function (res) {
            $("#image-" + id).remove();
        }
    });
}

