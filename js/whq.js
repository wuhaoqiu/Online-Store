/*global $:false*/
/*jslint browser: true */
/*global window */



$(function () {
    //create auto slideshow
    function autoshow() {
        var slides = $(".slidepicture");
        slides.hide();
        slideIndex2++;
        if (slideIndex2 > slides.length)
            slideIndex2 = 1;
        slides.eq(slideIndex2 - 1).show();
        window.setTimeout(autoshow, 3000);
    }
    var slideIndex2 = 0;
    autoshow();

    //create the mannul slideshow
    var slides = $(".slidepicture");
    var dots = $(".dot");
    slides.eq(0).show();
    dots.eq(0).addClass("active");
    dots.eq(1).removeClass("active");

    $(".dot").eq(1).on("click", function () {
        slides.eq(0).hide();
        slides.eq(1).show();
        dots.eq(1).addClass("active");
        dots.eq(0).removeClass("active");

    });
    $(".dot").eq(0).on("click", function () {
        slides.eq(1).hide();
        slides.eq(0).show();
        dots.eq(0).addClass("active");
        dots.eq(1).removeClass("active");
    });
    var slideIndex = 1;
    $(".prev").on("click", function () {
        slideIndex += -1;
        if (slideIndex > slides.length)
            slideIndex = 1;
        if (slideIndex < 1)
            slideIndex = slides.length;
        if (slideIndex == 1) {
            slides.eq(1).hide();
            slides.eq(0).show();
            dots.eq(0).addClass("active");
            dots.eq(1).removeClass("active");
        }
        if (slideIndex == 2) {
            slides.eq(0).hide();
            slides.eq(1).show();
            dots.eq(1).addClass("active");
            dots.eq(0).removeClass("active");
        }
    });
    $(".next").on("click", function () {
        slideIndex += 1;
        if (slideIndex > slides.length)
            slideIndex = 1;
        if (slideIndex < 1)
            slideIndex = slides.length;
        if (slideIndex == 1) {
            slides.eq(1).hide();
            slides.eq(0).show();
            dots.eq(0).addClass("active");
            dots.eq(1).removeClass("active");
        }
        if (slideIndex == 2) {
            slides.eq(0).hide();
            slides.eq(1).show();
            dots.eq(1).addClass("active");
            dots.eq(0).removeClass("active");
        }
    }); //end of next slide event


    $("form").submit(function () {
            var content = $(".searchproduct .searchinput").val();
            if (content == "") {
                window.alert("missing search content");
                return false;
            } //end of if
        } //end of submit vadilation
    )


})






//

//
