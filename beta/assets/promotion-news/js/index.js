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
$(document).ready(function() {
    fixFloatButton();
    getList('promotion-news?per-page=100', function(data) {
        if (data) {
            addPromotionNews(data);
        }
    });
    getList('panels', function(data) {
        if (data) {
            addPanel(data);
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
