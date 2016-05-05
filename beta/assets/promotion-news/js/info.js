function getAliasFromUrl() {
    return window.location.href.split('/').pop().split('.html')[0];
}

function setPromotionNews(news) {
    $('#promotion-news-box').html(news);
}

function addPanel(panel) {
    $('#panel-box').append(panel);
}

$(document).ready(function() {
    getItem('promotion-news/' + getAliasFromUrl(), function(news) {
        setPromotionNews(news);
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
