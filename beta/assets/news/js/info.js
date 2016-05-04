function getAliasFromUrl() {
    return window.location.href.split('/').pop().split('.html')[0];
}

function setNews(news) {
    $('#news-box').html(news);
}

function addPopular(news) {
    $('#popular-box').append(news);
}

function addPanel(panel) {
    $('#panel-box').append(panel);
}
$(document).ready(function() {
    getItem('news/' + getAliasFromUrl(), function(news) {
        setNews(news);
    });
    getList('news/popular', function(data) {
        if (data) {
          addPopular(data);
        }
    });
    getList('panels', function (data) {
        if (data) {
          addPanel(data);
        }
    });
});
