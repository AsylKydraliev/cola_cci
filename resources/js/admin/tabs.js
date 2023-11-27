$(document).ready(function () {
    $("#game").show();
    $("#question").hide();

    $(".nav-link").click(function () {
        var tab = $(this).attr("href");

        $(".tab-content").hide();
        $(tab).show();

        $(".nav-link").removeClass("active");
        $(this).addClass("active");

        return false;
    });
});
