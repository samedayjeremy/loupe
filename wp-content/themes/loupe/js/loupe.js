

$(document).ready(function() {
    
    $('.fancybox').fancybox();

    $(".watch-filters .manufacturers .term-wrapper").click(function() {
        var this_term = $(this).attr("data-slug");
        if($(this).hasClass("active")) {
            $(this).removeClass("active");
            for(var i = filter_search['manufacturers'].length - 1; i >= 0; i--) {
                if(filter_search['manufacturers'][i] === this_term) {
                   filter_search['manufacturers'].splice(i, 1);
                }
            }
        } else {
            $(this).addClass("active");
            filter_search['manufacturers'].push(this_term);
        }  
    });

    $(".watch-filters .prices .term-wrapper").click(function() {
        var this_term = $(this).attr("data-slug");
        if($(this).hasClass("active")) {
            $(this).removeClass("active");
            for(var i = filter_search['prices'].length - 1; i >= 0; i--) {
                if(filter_search['prices'][i] === this_term) {
                   filter_search['prices'].splice(i, 1);
                }
            }
        } else {
            $(this).addClass("active");
            filter_search['prices'].push(this_term);
        }  
    });

    $(".filter-submit a").click(function() {
        var url = "/";
        var has_manufacturers = false;
        if (filter_search['manufacturers'].length > 0 ) {
            url += "?manufacturer=" + filter_search["manufacturers"].join(",");
            var has_manufacturers = true;
        }
        if(filter_search['prices'].length > 0) {
            if(has_manufacturers) {
                url += "&"
            } else {
                url += "?"
            }
            url += "price=" + filter_search['prices'].join(",");
        }
        window.location.href = url;
    });

    $(".load-more").click(function() {
        $(".load-more").hide();
    });
    $('.watch-content').infinitescroll({
        loading: {
          finished: undefined,
          finishedMsg: "<em>No more watches</em>",
          img: "wp-content/themes/loupe/images/ajax-loader.gif",
          msg: null,
          msgText: "",
          selector: null,
          speed: 'fast',
          start: undefined
        },
        behavior: "twitter",
        nextSelector: ".load-more a:first",
        navSelector: ".load-more",
        contentSelector: ".watch-content", // rename to pageFragment
        itemSelector: ".watch-set"
        /*maxPage: total_pages*/
    },
    function(arrayOfNewElems)
    {
        $(".load-more").show();
    }
    );

    $(".thumb-img").click(function() {
        var img_src = $(this).data("big-img");
        $(".thumb-img").removeClass("active");
        $(this).addClass("active");
        $(".first-pic").fadeOut(100, function() { $(this).attr("src", img_src); })
        $(".first-pic").fadeIn();
    });

    $('#navbtn').click(function() {
        //$(this).css("position", "absolute").css("left", "15px");
        //$(this).css("z-index", 999)
        var $marginLefty = $(".left-menu");
        var val = parseInt($marginLefty.css('marginLeft'),10) == 0 ? $marginLefty.outerWidth() : 0;

        $marginLefty.animate({
          marginLeft: val
        });
        if (val === 0) {
            //$(this).css("position", "relative").css("left", "0px");
            //$(this).css("z-index", 999);
            val = 15;
        } //else {
            //$(this).css("position", "absolute").css("left", "15px");
            //$(this).css("z-index", 999);
        //}
        $("#navbtn").animate( { marginLeft: val });
        
    });
    $("#masthead .filter").click(function() {
        $(".watch-filters").slideToggle();
    });

    var original_right = parseInt($("#search-box").css("right"));
    var search_width = parseInt($("#masthead .search").width());
    var new_right = original_right - search_width;
    var out = true;
console.log(original_right);
console.log(search_width);

    //$("#search-box").css("right", new_right);
    $("#masthead .search").click(function() {

        var $searchbox = $("#search-box");
        if(out) {
            val = search_width + 20;
        } else {
            val = original_right;

        }
        out = !out;
        $searchbox.animate({
          right: val
        });
    });

    $("#masthead .col-xs-4").hover(function() {
        $(this).addClass("over");
    }, function() {
         $(this).removeClass("over");
    }
    );

    $("#searchsubmit").click(function(e) {
        
        if($(".searchform #s").val() == "") {
            e.preventDefault();
            return false;
        }
    });
});