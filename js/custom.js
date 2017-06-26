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
    })
})