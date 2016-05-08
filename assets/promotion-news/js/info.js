function getAliasFromUrl() {
    return window.location.href.split('/').pop().split('.html')[0];
}

function setPromotionNews(news) {
    $('#promotion-news-box').html(news);
}

function addPanel(panel) {
    $('#panel-box').append(panel);
}

function isPageLoaded() {
    return isPromotionNewsLoaded && isPanelsLoaded;
}

var isPromotionNewsLoaded = false;
var isPanelsLoaded = false;

$(document).ready(function() {
    getItem('promotion-news/' + getAliasFromUrl(), function(news) {
        setPromotionNews(news);
        isPromotionNewsLoaded = true;
    });

    getList('panels?per-page=100', function(data) {
        addPanel(data);
        isPanelsLoaded = true;
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
