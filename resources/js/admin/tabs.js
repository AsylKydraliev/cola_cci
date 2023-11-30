$(document).ready(function () {
    $("#game").show();
    $("#question").hide();

    $(".nav-link").click(function () {
        const tab = $(this).attr("href");

        $(".tab-content").hide();
        $(tab).show();

        $(".nav-link").removeClass("active");
        $(this).addClass("active");

        return false;
    });
});

$(document).ready(function () {
    $(".next-step").click(function () {
        $("#game").hide();
        $("#question").show();

        $('.game-link').removeClass("active");
        $('.game-link').addClass("disabled");
        $('.question-link').addClass("active");
    });

    $(".prev-step").click(function () {
        $("#game").show();
        $("#question").hide();

        $('.question-link').removeClass("active");
        $('.game-link').addClass("active");
    });
});
