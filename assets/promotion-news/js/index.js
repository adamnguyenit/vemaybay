function fixFloatButton() {
    $('.promotion-news .btn').each(function() {
        var parent = $(this).parent('.promotion-news');
        $(this).css('bottom', parent.find('h2').outerHeight(true) + parent.find('p').outerHeight(true) - $(this).height() / 2 + 5);
    });
}

function addPromotionNews(news) {
    $('#promotion-news-box').append(news);
    fixFloatButton();
}

function addPanel(panel) {
    $('#panel-box').append(panel);
}

function addSlide(slide) {
    $('#promotions-slider').prepend(slide);
    $('#promotions-slider').carousel();
}

function isPageLoaded() {
    return isPromotionNewsLoaded && isSlidesLoaded && isPanelsLoaded;
}

var isPromotionNewsLoaded = false;
var isSlidesLoaded = false;
var isPanelsLoaded = false;

$(document).ready(function() {
    fixFloatButton();

    getList('promotion-news?per-page=100', function(data) {
        if (data) {
            addPromotionNews(data);
            isPromotionNewsLoaded = true;
        }
    });

    getList('panels?per-page=100', function(data) {
        if (data) {
            addPanel(data);
            isPanelsLoaded = true;
        }
    });

    getList('slides?per-page=100', function(data) {
        if (data) {
            addSlide(data);
            isSlidesLoaded = true;
        }
    });

    $('[name=round-trip]').change(function() {
        var value = $(this).val();
        if (value == 0) {
            $('.show-unless-round-trip').hide();
        } else {
            $('.show-unless-round-trip').show();
        }
    });
});

$(window).resize(function() {
    fixFloatButton();
});
