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
                $(".new-post-form").append("<input style='display: none' name='photo' value='" + res + "'>");
            }
        });
    })
})