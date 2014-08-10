$(document).ready(function() {
    $('.watch-content').infinitescroll({
        loading: {
          finished: undefined,
          finishedMsg: "<em>Congratulations, you've reached the end of the internet.</em>",
                      img: null,
          msg: null,
          msgText: "<em>Loading the next set of posts...</em>",
          selector: null,
          speed: 'fast',
          start: undefined
        },
        behavior: "twitter",
        nextSelector: ".load-more a:first",
        navSelector: ".load-more",
        contentSelector: ".watch-content", // rename to pageFragment
        itemSelector: ".watch-box"     
    });

    $(".thumb-img").click(function() {
        var img_src = $(this).data("big-img");
        $(".thumb-img").removeClass("active");
        $(this).addClass("active");
        $(".first-pic").fadeOut(100, function() { $(this).attr("src", img_src); })
        $(".first-pic").fadeIn();
    });

    $('#navbtn').click(function() {
        var $marginLefty = $(".left-menu");
        var val = parseInt($marginLefty.css('marginLeft'),10) == 0 ? $marginLefty.outerWidth() : 0;

        $marginLefty.animate({
          marginLeft: val
        });
        if (val === 0) {
            val = 15;
        }
        $("#navbtn").animate( { marginLeft: val });
    });
});