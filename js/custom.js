$('document').ready(function () {
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
                console.log(res);
                $("#uploaded-img").attr("src", "../../uploaded/" + res);
                $("#success-upload").fadeIn(300);
                $("#uploaded-image").remove();
                if($(".new-post-form").length){
                    $(".new-post-form").append("<input id='uploaded-image' style='display: none' name='photo' value='" + res + "'>");
                } else if($(".edit-post-form").length){
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
                console.log(res);
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
            console.log(res);
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